<?php

namespace App\Http\Controllers;

use App\chefDepartement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use PDF;
use App\Departement;
use App\DepartementEntreprise;
use App\entreprise;
use App\stagiaire;
use App\User;
use App\responsable;
use Illuminate\Support\Facades\File;
use App\Models\FonctionGenerique;

/* ====================== Exportation Excel ============= */
use App\Exports\ParticipantExport;
use Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ParticipantController extends Controller
{
    public function index()
    {
        $email_error = "";
        $matricule_error = "";
        $user_id = Auth::user()->id;

        if (Gate::allows('isSuperAdmin')) {
            $liste_etp = entreprise::orderBy("nom_etp")->get();
            $liste_dep = Departement::all();
            return view('admin.participant.nouveauParticipant', compact('liste_dep', 'liste_etp', 'email_error', 'matricule_error'));
        }
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            $liste_dep = DepartementEntreprise::with('Departement')->where('entreprise_id', $entreprise_id)->get();
            return view('admin.participant.nouveauParticipant', compact('liste_dep', 'email_error', 'matricule_error'));
        }

        if (Gate::allows('isManager')) {

            $entreprise_id =chefDepartement::where('user_id', [$user_id])->value('entreprise_id');
            $fonct = new FonctionGenerique();
            $chef = $fonct->findWhereMulitOne("v_chef_departement_entreprise",
            ["entreprise_id","user_id_chef_departement"],
            [$entreprise_id,$user_id]);

            $liste_dep = DepartementEntreprise::with('Departement')->where('entreprise_id', $entreprise_id)->where('departement_id',[$chef->departement_id])->get();
            return view('admin.participant.nouveauParticipant', compact('liste_dep', 'email_error', 'matricule_error'));
        }
    }

    public function create($id = null)
    {
        $user_id = Auth::user()->id;
        $liste_etp = entreprise::orderBy('nom_etp')->get();
        if (Gate::allows('isSuperAdmin')) {
            $datas = stagiaire::with('entreprise', 'User')->get();
        }
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', [$user_id])->value('entreprise_id');
            $datas = stagiaire::with('entreprise', 'User')->where('entreprise_id',[$entreprise_id])->get();
        }
        if (Gate::allows('isManager')) {
            $entreprise_id = chefDepartement::where('user_id', [$user_id])->value('entreprise_id');
            $fonct = new FonctionGenerique();
            $chef = $fonct->findWhereMulitOne("v_chef_departement_entreprise",
            ["entreprise_id","user_id_chef_departement"],
            [$entreprise_id,$user_id]);

            $datas = stagiaire::with('entreprise', 'User')->where('entreprise_id',[$entreprise_id])->where('departement_id',[$chef->departement_id])->get();
        }


        // if ($entreprise_id) {
        //     $datas = Stagiaire::orderBy('nom_stagiaire')->with('entreprise')->where('entreprise_id', $entreprise_id)->get();
        // } else {
        //     if ($id) {
        //         $datas = Stagiaire::orderBy('nom_stagiaire')->with('entreprise', 'user')->take($id)->get();
        //     } else {
        //         $datas = Stagiaire::orderBy('nom_stagiaire')->with('entreprise', 'user')->get();
        //     }
        // }

        // dd($datas);
        $info_impression = [
            'id' => null,
            'nom_entreprise' => 'Tout'
        ];
        return view('admin.participant.participant', compact('liste_etp', 'datas', 'info_impression'));
    }

    public function store(Request $request)
    {
        //condition de validation de formulaire
        $request->validate(
            [
                'matricule' => ["required"],
                'nom' => ["required"],
                'prenom' =>  ["required"],
                'fonction' => ["required"],
                'mail' => ["required", "email"],
                'phone' => ["required"],
                'lieu' => ["required"],
                'image' => ["required"],
                'cin' =>  ["required"],
                'adresse' =>  ["required"]
            ],
            [
                'matricule.required' => 'Veuillez remplir le champ',
                'nom.required' => 'Veuillez remplir le champ',
                'prenom.required' => 'Veuillez remplir le champ',
                'fonction.required' =>  'Veuillez remplir le champ',
                'mail.required' =>  'Veuillez remplir le champ',
                'mail.email' => 'Addresse mail non valide',
                'phone.required' => 'Veuillez remplir le champ',
                'image.required' => "Veuillez importer une photo",
                'cin.required' => 'Entrer le CIN',
                'adresse.required' => 'Entrez l\'adresse',
            ]
        );
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', Auth::user()->id)->value('entreprise_id');
        }
        if (Gate::allows('isManager')) {
            $entreprise_id = chefDepartement::where('user_id', Auth::user()->id)->value('entreprise_id');
        }
        if (Gate::allows('isSuperAdmin')) {
            $entreprise_id = $request->liste_etp;
        }


        $participant = new stagiaire();
        $email = $participant->checkEmail($request->mail);
        $mat = $participant->checkMatricule($request->matricule);
        if ($email && $mat) {
            $email_error = "Cette addresse e-mail existe déjà.";
            $matricule_error = "Le numéro matricule saisi existe déjà.";
            $liste_etp = entreprise::orderBy("nom_etp")->get();
            return view('admin.participant.nouveauParticipant', compact('liste_etp', 'email_error', 'matricule_error'));
        } elseif ($email) {
            $email_error = "Cette addresse e-mail existe déjà.";
            $matricule_error = "";
            $liste_etp = entreprise::orderBy("nom_etp")->get();
            return view('admin.participant.nouveauParticipant', compact('liste_etp', 'email_error', 'matricule_error'));
        } elseif ($mat) {
            $email_error = "";
            $matricule_error = "Le numéro matricule saisi existe déjà.";
            $liste_etp = entreprise::orderBy("nom_etp")->get();
            return view('admin.participant.nouveauParticipant', compact('liste_etp', 'email_error', 'matricule_error'));
        } else {
            $participant->matricule = $request->matricule;
            $participant->nom_stagiaire = $request->nom;
            $participant->lieu_travail = $request->lieu;
            $participant->prenom_stagiaire = $request->prenom;
            $participant->genre_stagiaire = $request->genre;
            $participant->fonction_stagiaire = $request->fonction;
            $participant->mail_stagiaire = $request->mail;
            $participant->telephone_stagiaire = $request->phone;
            $nom_image = str_replace(' ', '_', $request->nom . '' . $request->prenom . '' . $request->matricule . '.' . $request->image->extension());

            $str = 'images/stagiaires';

            $participant->photos = $nom_image;

            //enregistrer les emails , name et mot de passe dans user
            $user = new User();
            $user->name = $request->nom;
            $user->email = $request->mail;
            $ch1 = $request->nom;
            $ch2 = substr($request->phone, 8, 2);
            $user->password = Hash::make($ch1 . $ch2);
            $user->role_id = '3';
            $user->save();
            //get user id
            $user_id = User::where('email', $request->mail)->value('id');
            $participant->user_id = $user_id;

            $participant->departement_id = $request->liste_dep;
            $participant->CIN = $request->cin;
            $participant->date_naissance = $request->naissance;
            $participant->adresse = $request->adresse;
            $participant->niveau_etude = $request->niveau;
            $participant->entreprise_id = $entreprise_id;
            $participant->save();
            $request->image->move(public_path($str), $nom_image);

            return redirect()->route('liste_participant');
        }
    }

    public function show($id)
    {
        $liste_etp = entreprise::orderBy('nom_etp')->get();
        $datas = stagiaire::orderBy('nom_stagiaire')->where('entreprise_id', $id)->get();

        $info = entreprise::orderBy("nom_etp")->where('id', $id)->get();
        $info_impression = [
            'id' => $info[0]->id,
            'nom_entreprise' => $info[0]->nom_etp
        ];
        return view('admin.participant.participant', compact('datas', 'liste_etp', 'info_impression'));
    }

    public function edit($id, Request $request)
    {
        if ($id != null) {
            $user_id =  $users = Auth::user()->id;
            $stagiaire_connecte = stagiaire::where('user_id', $user_id)->exists();
            $stagiaire = stagiaire::findOrFail($id);

            return view('admin.participant.update', compact('stagiaire'));
        } else {


            $participant = stagiaire::where('id', $id)->get();

            return response()->json($participant);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id_get;
        stagiaire::where('id', $id)->update([
            'matricule' => $request->matricule,
            'nom_stagiaire' => $request->nom,
            'prenom_stagiaire' => $request->prenom,
            'date_naissance' => $request->date,
            'genre_stagiaire' => $request->genre,
            'fonction_stagiaire' => $request->fonction,
            'telephone_stagiaire' => $request->phone,
            'mail_stagiaire' => $request->mail,
            'cin' => $request->cin,
            'adresse' => $request->adresse,
            'niveau_etude' => $request->niveau
        ]);
        return back();
    }

    public function destroy(Request $request)
    {
        $id = $request->id_get;
        $stag = stagiaire::findOrFail($id);
        $user_id = stagiaire::where('id', $id)->value('user_id');
        $del_stagiaire = stagiaire::where('id', $id)->delete();
        $del_user = User::where('id', $user_id)->delete();
        File::delete("images/stagiaires/".$stag->photos);
        return back();
    }

    public function getStagiaires(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $stagiaires = stagiaire::orderby('matricule', 'asc')->select('id', 'matricule')->limit(5)->get();
        } else {
            $stagiaires = stagiaire::orderby('matricule', 'asc')->select('id', 'matricule')->where('matricule', 'like', $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($stagiaires as $stagiaire) {
            $response[] = array("value" => $stagiaire->id, "label" => $stagiaire->matricule);
        }
        return response()->json($response);
    }

    public function getStagiairesFonction(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $stagiaires = stagiaire::orderby('fonction_stagiaire', 'asc')->select('id', 'fonction_stagiaire')->limit(5)->get();
        } else {
            $stagiaires = stagiaire::orderby('fonction_stagiaire', 'asc')->select('id', 'fonction_stagiaire')->where('fonction_stagiaire', 'like', $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($stagiaires as $stagiaire) {
            $response[] = array("value" => $stagiaire->id, "label" => $stagiaire->fonction_stagiaire);
        }
        return response()->json($response);
    }

    public function recherche(Request $request)
    {
        $matricule = $request->matricule;
        if ($matricule == '') {
            $datas = stagiaire::get();
        } else {
            $datas = stagiaire::where('matricule', $matricule)->get();
        }
        $liste_etp = entreprise::orderBy('nom_etp')->get();
        $info_impression = [
            'id' => null,
            'nom_entreprise' => 'Tout'
        ];
        return view('admin.participant.participant', compact('liste_etp', 'datas', 'info_impression'));
    }

    public function rechercheFonction(Request $request)
    {
        $fonction = $request->fonction;
        if ($fonction == '') {
            $datas = stagiaire::get();
        } else {
            $datas = stagiaire::where('fonction_stagiaire', $fonction)->get();
        }
        $liste_etp = entreprise::orderBy('nom_etp')->get();
        $info_impression = [
            'id' => null,
            'nom_entreprise' => 'Tout'
        ];
        return view('admin.participant.participant', compact('liste_etp', 'datas', 'info_impression'));
    }
    /*
        ====================  Generate PDF Liste des stagiaire par Entreprise
    */
    public function generatePDF($id = null)
    {
        $entreprise = new entreprise();
        $stagiaire = new stagiaire();

        $nom_entr = null;

        if ($id == null) {
            $entreprises = $entreprise->orderBy('nom_etp')->get();
            $stagiaires = $stagiaire->orderBy('nom_stagiaire')->with('entreprise', 'User')->get();

            $info_impression = [
                'id' => null,
                'nom_entreprise' => 'Tout'
            ];
        } else {
            $entreprises = $entreprise->orderBy('nom_etp')->where('id', $id)->get();
            $stagiaires = $stagiaire->orderBy('nom_stagiaire')->where('entreprise_id', $id)->get();
            $info_impression = [
                'id' => $entreprises[0]->id,
                'nom_entreprise' => $entreprises[0]->nom_etp
            ];
            $nom_entr = $entreprises[0]->nom_etp;
        }

        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $pdf = PDF::loadView('admin.pdf.pdf_stagiaire', compact('entreprises', 'stagiaires'));

        if ($id != null) {
            return $pdf->download('liste des stagiaires de ' . $nom_entr . '.pdf');
        } else {
            return $pdf->download('gestion des stagiaires.pdf');
        }
    }
    public function export()
    {
        return Excel::download(new ParticipantExport, 'gestion des stagiaires.xlsx');
    }
    public function profile_stagiaire($id = null)
    {
        $user_id =  $users = Auth::user()->id;
        $stagiaire_connecte = stagiaire::where('user_id', $user_id)->exists();
        if ($stagiaire_connecte) {
            $stagiaires =stagiaire::with('entreprise', 'Departement')->where('user_id', $user_id)->get();
        } else {
            $stagiaires = stagiaire::with('entreprise', 'Departement')->where('id', $id)->get();
        }
        // $stagiaire=stagiaire::findOrFail($id);
        return view('admin.participant.profile', compact('stagiaires'));
    }
    //update_stagieir connecte
    public function update_stagiaire(Request $request, $id)
    {
        $user_id =  $users = Auth::user()->id;
        $stagiaire_connecte = stagiaire::where('user_id', $user_id)->exists();

        $stagiaires = stagiaire::with('entreprise', 'Departement')->where('user_id', $user_id)->get();
        stagiaire::where('id', $id)->update([
            'matricule' => $request->matricule,
            'nom_stagiaire' => $request->nom,
            'prenom_stagiaire' => $request->prenom,
            'date_naissance' => $request->date,
            'fonction_stagiaire' => $request->fonction,

            'niveau_etude' => $request->niv,
            'telephone_stagiaire' => $request->phone,
            'mail_stagiaire' => $request->mail,
            'adresse' => $request->adresse
        ]);
        $password = $request->password;
        $nom = $request->nom;
        $mail = $request->mail;
        $hashedPwd = Hash::make($password);
        $user = User::where('id', Auth::user()->id)->update([
            'password' => $hashedPwd, 'name' => $nom, 'email' => $mail
        ]);
        return redirect()->route('profile_stagiaire', $id);
    }
}