@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cadastro - Nova Vaga</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br />
            @include('helpers.messages')
            <form method="post" action="{{url('/dashboard/jobs/store')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Título da Vaga <span class="required">*</span></label>
                    <input name="title"  value="{{old('title')}}" type="text" class="form-control" id="name" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="description">Descrição <span class="required">*</span></label>
                    <textarea rows="6" name="description"  value="{{old('description')}}" class="form-control" id="description" placeholder="Descrição">{{old('description')}}</textarea>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="state_id">Estados <span class="required">*</span></label>
                        <select name="state_id" value="{{old('state_id')}}" class="form-control" id="state_id">
                            <option value="">Selecione</option>
                            @foreach($states as $sta)
                                <option value="{{$sta->id}}">{{$sta->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="city_id">Cidade <span class="required">*</span></label>
                        <select name="city_id" value="{{old('password')}}"  type="city" class="form-control" id="city_id">
                            
                        </select>
                    </div>
                    <div class="col">
                        <label for="status">Status <span class="required">*</span></label>
                        <select name="status" value="{{old('password')}}" class="form-control" id="status">
                            <option value="">Selecione</option>
                            <option value="1">Ativo</option>
                            <option value="0">Desativado</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="date_begin">Início de Publicação <span class="required">*</span></label>
                        <input name="date_begin" value="{{old('date_begin')}}"  type="date" class="form-control" id="date_begin">
                    </div>
                    <div class="col">
                        <label for="date_end">Fim de Publicação</label>
                        <input name="date_end" value="{{old('date_end')}}" type="date" class="form-control" id="date_end" >
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6">
                    <a href="{{url('/dashboard/jobs')}}" class="btn btn-warning">Cancelar</a>
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
        $("#state_id").change(function() {
            axios.get("{{url('/dashboard/states/list-city-by-id')}}" + '/' + $(this).val())
            .then(function(response) {
                var options = '<option value="">Selecione</option>';
                for (var i = 0; i < response.data.length; i++) {
                    options += '<option value="' +
                    response.data[i].id + '">' +
                    response.data[i].name + '</option>';
                }
                $('#city_id').html(options);
            })
            .catch(function(error){
                console.log(error);
            });
        });
    </script>
@endsection