@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Usuários</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @include('helpers.form-search')
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{url('/dashboard/users/create')}}" class="btn btn-success">Novo Usuário</a>
                </div>
            </div>
            <br />
            @include('helpers.messages')
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th style="width: 40px">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td style="width: 180px;" class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{url('/dashboard/users/edit/'.$user->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Editar
                                </a>
                                <a id="confirmation-delete" data-info="{{url('/dashboard/users/delete/'.$user->id)}}" class="btn btn-danger btn-sm" href="#">
                                <!-- <a id="confirmation-delete" class="btn btn-danger btn-sm" href="{{url('/dashboard/users/delete/'.$user->id)}}"> -->
                                    <i class="fas fa-trash"></i>
                                    Deletar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br />
            {{ $users->links() }}
        </div>
    </div>
@endsection 