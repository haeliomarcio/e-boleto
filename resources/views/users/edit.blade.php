@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edição - Usuário - {{$user->name}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br />
            @include('helpers.messages')
            <form method="POST" action="{{url('/dashboard/users/update/'.$user->id)}}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                        <label for="inputName">Nome <span class="required">*</span></label>
                        <input name="name"  value="{{$user->name}}" type="text" class="form-control" id="inputName" placeholder="Nome">
                    </div>
                    <div class="col">
                        <label for="inputEmail">Email <span class="required">*</span></label>
                        <input name="email"  value="{{$user->email}}" type="email" class="form-control" id="inputEmail" placeholder="name@example.com">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="inputSenha">Senha <span class="required">*</span></label>
                        <input name="password"  type="password" class="form-control" id="inputSenha" placeholder="**********">
                    </div>
                    <div class="col">
                        <label for="inputConfirmaSenha">Confirmar Senha <span class="required">*</span></label>
                        <input name="password_confirmation" type="password" class="form-control" id="inputConfirmaSenha" placeholder="**********">
                    </div>
                    <div class="col">
                        <label for="inputPerfil">Perfil <span class="required">*</span></label>
                        <select name="type" class="form-control">
                            <option value="">Selecione</option>
                            <option value="admin" <?php echo $user->type == 'admin' ? 'selected' : ''; ?>>Administrador</option>
                            <option value="editor" <?php echo $user->type == 'editor' ? 'selected' : ''; ?>>Editor</option>
                        </select>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6">
                    <a href="{{url('/dashboard/users')}}" class="btn btn-warning">Cancelar</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection 