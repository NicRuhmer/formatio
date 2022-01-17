@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
                <br>
                <div class="text-center">
                <i class="fa fa fa-building fa-5x" aria-hidden="true"></i>
                </div>
                <h1 class="text-center mt-5 "  style="font-weight:bold">Vous n'avez pas encore collaborer!</h1><br>
            </div>

            <div class="text-center">
                <div class="body">
                  <h5 class="title">Veuillez collaborer avec une Entreprise</h5>
                  <p class="text"></p>
                  <p class="text"></p>
                  <a href="{{route('collaboration')}}" class="btn btn-outline-warning">Ajouter nouveau Collaborateur</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection