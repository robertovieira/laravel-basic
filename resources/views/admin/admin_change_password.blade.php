@extends('admin.admin_master')

@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Alterar senha de acesso</h4>

                        @if (count($errors))
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger alert-dismissible fade show">{{ $error }}</p>                                
                            @endforeach
                        @endif
                        
                        <form class="mt-5" method="post" action="{{ route('update.password') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="old_password" class="col-sm-2 col-form-label">Senha atual</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="old_password" value="" type="password" id="old_password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="new_password" class="col-sm-2 col-form-label">Nova senha</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="new_password" value="" type="password" id="new_password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="confirm_password" class="col-sm-2 col-form-label">Confirme a senha</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="confirm_password" value="" type="password" id="confirm_password">
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Alterar senha">

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

@endsection