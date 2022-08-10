@extends('admin.admin_master')

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <br>
                    <br>
                    <center>
                        <img class="rounded-circle avatar-xl" src="{{ (!empty($userData->profile_image)) ? url('upload/admin_images/' . $userData->profile_image) : url('upload/no_image.jpg') }}" alt="Card image cap">
                    </center>

                    <div class="card-body">
                        <h4 class="card-title">Nome: {{ $userData->name }}</h4>
                        <hr>
                        <h4 class="card-title">Usuário: {{ $userData->username }}</h4>
                        <hr>
                        <h4 class="card-title">Email: {{ $userData->email }}</h4>
                        <hr>
                        <a href="{{ route('edit.profile') }}" class="btn btn-info waves-effect waves-light">Editar Perfil</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection