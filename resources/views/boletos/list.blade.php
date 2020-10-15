@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Boletos</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @include('helpers.form-search')
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{url('/boletos/create')}}" class="btn btn-success">Novo Boleto</a>
                </div>
            </div>
            <br />
            @include('helpers.messages')
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Boleto</th>
                    <th>Competência</th>
                    <th style="width: 40px">Ações</th>
                </tr>   
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->status ? 'Ativo' : 'Desativado' }}</td>
                            <td style="width: 180px;" class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{url('/dashboard/jobs/edit/'.$item->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Editar
                                </a>
                                <a id="confirmation-delete" data-info="{{url('/dashboard/jobs/delete/'.$item->id)}}" class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash"></i>
                                    Deletar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br />
            {{ $list->links() }}
        </div>
    </div>
@endsection 