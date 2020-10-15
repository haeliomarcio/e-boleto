@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Histórico de Envio</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @include('helpers.form-search')
                </div>
                <div class="col-md-6 text-right">
                    <!-- <a href="{{url('/dashboard/stores/create')}}" class="btn btn-success">Nova Loja</a> -->
                </div>
            </div>
            <br />
            @include('helpers.messages')
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Cliente</th>
                    <th>Competência</th>
                    <th style="width: 40px">Status</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->client->name }}</td>
                            <td>{{ $item->competence }}</td>
                            <td style="width: 180px;" class="project-actions text-right">
                                {{ $item->status ? 'Enviado' : 'Não enviado'}}
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