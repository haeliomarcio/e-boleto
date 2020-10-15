@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edição - Cliente - {{$data->name}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br />
            @include('helpers.messages')
            <form method="post" action="{{url('/clients/update/'.$data->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Nome <span class="required">*</span></label>
                    <input name="name"  value="{{$data->name}}" type="text" class="form-control" id="name" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="email">E-mail <span class="required">*</span></label>
                    <input name="email"  value="{{$data->email}}" type="text" class="form-control" id="email" placeholder="Email">
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6">
                    <a href="{{url('/clients')}}" class="btn btn-warning">Cancelar</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection 
@section('scripts')
    <script>
        tinymce.init({
            selector: 'textarea',  // change this value according to your HTML
            menu: {
                happy: {title: 'Happy', items: 'code'}
            },
            plugins: 'code',  // required by the code menu item
            menubar: 'happy'  // adds happy to the menu bar
        });
    </script>
@endsection