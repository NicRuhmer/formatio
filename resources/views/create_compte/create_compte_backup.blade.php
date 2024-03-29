<link rel="stylesheet" href="{{asset('css/profil_formateur.css')}}">

<link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
<title> formation.mg </title>
{{-- catalogue --}}
<!-- Bootstrap Core CSS -->
<link href="{{asset('bootstrapCss/css/bootstrap.min.css')}} " rel="stylesheet">

{{-- Boxicon --}}
<link href="{{asset('assets/css/boxicons.min.css')}} " rel="stylesheet">

<!-- Custom CSS -->
<link href="{{asset('assets/css/chart_et_font.css')}}" rel="stylesheet">

<!-- Custom Fonts -->
<link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

<!-- full calendar -->
<link href="{{asset('assets/fullcalendar/lib/main.css')}}" rel='stylesheet' />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

<link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">

{{-- link fontawesome_all --}}
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link rel="stylesheet" href="{{asset('css/qcmStep.css')}}">

</head>
<body>

    {{-- <input type="text" name="searchname" class="form-control" id="name_entreprise_search" placeholder="search" /> --}}

    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="col-12">
                    <div class="img_top mt-4 text-center">
                        <img src="{{ asset('img/images/logo_fmg54Ko.png') }}" alt="background" class="img-fluid" style="width: 8rem; height: 8rem;">
                    </div>
                </div>
                <h2>Inscrivez gratuitement votre centre de formation sur <strong>formation.mg</strong></h2>
                <form action="{{route('create_compte_client')}}" id="msform" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- progressbar -->
                    <ul id="progressbar" class="mb-1">
                        <li class="active" id="etape1"></li>
                        <li id="etape2"></li>
                        <li id="etape3"></li>
                        <li id="etape4"></li>
                    </ul> <!-- fieldsets -->

                    <div id="formulaire">

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <div class="row">
                                <div class="col">
                                    <h3 class="position-center">Vous êtes ?<strong style="color:#ff0000;">*</strong></h3>
                                    <h6 style="color: black">Formulaire dédié aux Employeur et Organisation de Formation. Si vous cherchez une formation c'est par <a href="#" style="color: blue">ICI</a></h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <select class="form-select" aria-label="Default select example" name="entreprise_id" id="type_inscription">
                                        <option value="null" disabled selected hidden>Veuillez Sélectionner</option>
                                        <option value="1">Organisation de Formation (OF)</option>
                                        <option value="2">Employeur (responsable de l'entreprise)</option>
                                    </select>
                                </div>
                            </div>

                            <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />
                        </fieldset>

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            {{-- <h3 class="" id="desc_nom_cfp">Veuillez entrer le nom de votre entreprise</h3>
                            <label for="exampleFormControlInput1" class="form-label">Non de l'entreprise<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="name_entreprise" class="form-control" id="name_entreprise_search" /> --}}

                            <div id="info_nom_cfp">

                            </div>

                            <span style="color:#ff0000;" id="num_facture_err"></span>
                            <div id="info_legale_cfp"></div>

                            <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précedent" />
                            <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />

                        </fieldset>

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">

                            <h3 id="phrase_inscription">Veuillez certifier que vous etes le responsable de <strong id="name_entreprise_desc"></strong></h3>
                            <p>veuillez renseigner:</p>
                            <div class="row" id="changeCham">

                            </div>

                            <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précendent" />
                            <input type="button" name="make_payment" class="next action-button" style="background-color: red" value="Suivant" />
                        </fieldset>

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h5 class="">Après avoir remplir notre condition,vous pouvez maitenant activier votre.</strong></h5>
                            <h6>Avant d'activer votre,veuillez bien revérifier votre données!</h6>
                            <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précendent" />
                            <button type="submit" class="btn btn-danger">Activation</button>
                        </fieldset>

                    </div>



                </form>

            </div>

            <div class="col-md-3"></div>
        </div>
    </div>


    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    {{-- JQuery --}}
    <script src="{{asset('bootstrapCss/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('assets/js/boxicons.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/startmin.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/lib/main.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('function js/programme/edit_programme.js') }}"></script>
    <script src="{{asset('js/qcmStep.js')}}"></script>


    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        // ============ select type inscription cfp ou responsables

        $(document).on('change', '#type_inscription', function() {
            var id = $(this).val();

            if (id == 1) { // ====== inscription de type CFP ou OF
                $('#changeCham').empty();
                $('#info_legale_cfp').empty();
                $('#info_nom_cfp').empty();

                var html3 = '';
                var html = '';
                var html2 = '';

                html3 += '<h3>Veuillez entrer le nom de votre organisation de formation</strong></h3>';
                html3 += '<label for="exampleFormControlInput1" class="form-label">Non<strong style="color:#ff0000;">*</strong></label>';
                html3 += '<input type="text" name="name_cfp" class="form-control" id="name_cfp_search" />';

                document.getElementById('phrase_inscription').innerHTML = 'Veuillez certifier vos domaine et information';


                html2 += '<label for="exampleFormControlInput1" class="form-label">NIF<strong style="color:#ff0000;">*</strong></label>';
                html2 += '<input type="text" name="nif" required class="form-control" id="name_entreprise" />';
                html2 += ' <label for="exampleFormControlInput1" required class="form-label">STAT<strong style="color:#ff0000;">*</strong></label>';
                html2 += '<input type="text" name="stat" required class="form-control" id="name_entreprise" />';
                html2 += ' <label for="exampleFormControlInput1" required class="form-label">RCS<strong style="color:#ff0000;">*</strong></label>';
                html2 += '<input type="text" name="rcs" required class="form-control" id="name_entreprise" />';
                html2 += '<label for="exampleFormControlInput1" required class="form-label">CIF<strong style="color:#ff0000;">*</strong></label>';
                html2 += '<input type="text" name="cif" required class="form-control" id="name_entreprise" />';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Domaine<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" required name="domaine_cfp" class="form-control" id="domaine_cfp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Lot<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" required name="lot" class="form-control" id="lot" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Ville<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" required name="ville" class="form-control" id="ville" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Région<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" required name="region" class="form-control" id="region" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Email<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="email" required name="email_cfp" class="form-control" id="email_cfp" /></div>';


                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" max=10 required name="tel_cfp" class="form-control" id="tel_cfp"/></div>';
                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Web</label>';
                html += ' <input type="text"  name="web_cfp" class="form-control" id="web_cfp" /></div>';

                $('#info_nom_cfp').append(html3);
                $('#info_legale_cfp').append(html2);
                $('#changeCham').append(html);

            }

            if (id == 2) { // ====== inscription de type responsable de l'entreprise

                $('#changeCham').empty();
                $('#info_legale_cfp').empty();
                $('#info_nom_cfp').empty();

                document.getElementById('phrase_inscription').innerHTML = 'Veuillez certifier que vous etes le responsable de <strong id="name_entreprise_desc"></strong>';
                var html = '';
                var html3 = '';

                html3 += '<h3>Veuillez entrer le nom de votre entreprise</strong></h3>';
                html3 += '<label for="exampleFormControlInput1" class="form-label">Non<strong style="color:#ff0000;">*</strong></label>';
                html3 += '<input type="text" name="name_entreprise" class="form-control" id="name_entreprise_search" />';
                html3 += '<div id="teste_e"></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label " align="left">Non<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" required name="nom_resp" class="form-control" id="nom_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Prénom<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" required name="prenom_resp" class="form-control" id="prenom_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" required name="function_resp" class="form-control" id="function_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Email<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="email" required name="email_resp" class="form-control" id="email_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" max=10 required name="tel_resp" class="form-control" id="tel_resp" /></div>';

                $('#info_nom_cfp').append(html3);
                $('#changeCham').append(html);
            }

        });


        $(document).on('change', '#name_entreprise', function() {
            var id = $(this).val();
            document.getElementById('name_entreprise_desc').value = id;
            document.getElementById('name_entreprise_desc').innerHTML = id;
        });

        // ====== autoComplet Champs search nom entreprise

        $(document).ready(function() {


            $('#name_entreprise_search').autocomplete({


                source: function(request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , type: 'GET'
                        , url: "{{route('search_entreprise_referent')}}"
                        , data: {
                            search: request.term
                        }
                        , success: function(data) {
                            response(data);
                        }
                    });
                }
                , minlength: 1
                , autoFocus: true
                , select: function(e, ui) {
                    $('#name_entreprise_search').val(ui.item.nom_resp);
                }

            });


        });


        /*     $(document).on('change', '#name_entreprise_search', function() {
            var id = $(this).val();
            $.ajax({
            method: "GET"
            , url: "{{route('search_entreprise_referent')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {

                var userData = JSON.parse(response);
                if(userData.length>=0){

                    $('#teste_e').empty();
                    var html='';
                    html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label " align="left">Non<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" required name="nom_resp" class="form-control" id="nom_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Prénom<strong style="color:#ff0000;">*</strong></label>';
                html += '<input type="text" required name="prenom_resp" class="form-control" id="prenom_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" required name="function_resp" class="form-control" id="function_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Email<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="email" required name="email_resp" class="form-control" id="email_resp" /></div>';

                html += '<div class="form-ground"><label for="exampleFormControlInput1" class="form-label" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>';
                html += ' <input type="text" max=10 required name="tel_resp" class="form-control" id="tel_resp" /></div>';

                $('#teste_e').append(html);
                } else {

                }

            }
            , error: function(error) {
                console.log(error)
            }
        });

        });
*/

    </script>



</body>
</html>
