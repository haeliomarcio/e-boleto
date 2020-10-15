@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edição - Vaga - {{$data->title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br />
            @include('helpers.messages')
            <form method="POST" action="{{url('/dashboard/jobs/update/'.$data->id)}}">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Título da Vaga <span class="required">*</span></label>
                    <input name="title"  value="{{$data->title}}" type="text" class="form-control" id="name" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="description">Descrição <span class="required">*</span></label>
                    <textarea 
                        name="description" 
                        class="form-control" 
                        rows="6"
                        id="description" 
                        placeholder="Descrição">{{$data->description}}</textarea>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="state_id">Estados <span class="required">*</span></label>
                        <select name="state_id" value="{{$data->state_id}}" class="form-control" id="state_id">
                            <option value="">Selecione</option>
                            @foreach($states as $sta)
                                @if($data->state_id === $sta->id)
                                    <option value="{{$sta->id}}" selected>{{$sta->name}}</option>
                                @else
                                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                                @endif
                                
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="city_id">Cidade <span class="required">*</span></label>
                        <select name="city_id" value="{{$data->city_id}}"  type="city" class="form-control" id="city_id">

                        </select>
                    </div>
                    <div class="col">
                        <label for="status">Status <span class="required">*</span></label>
                        <select name="status" value="{{$data->status}}" class="form-control" id="status">
                            <option value="">Selecione</option>
                            <option value="1" {{$data->status ? 'selected' : ''}}>Ativo</option>
                            <option value="0" {{$data->status ? '' : 'selected'}}>Desativado</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="date_begin">Início de Publicação <span class="required">*</span></label>
                        <input name="date_begin" value="{{$data->date_begin}}"  type="date" class="form-control" id="date_begin">
                    </div>
                    <div class="col">
                        <label for="date_end">Fim de Publicação</label>
                        <input name="date_end" value="{{$data->date_end}}" type="date" class="form-control" id="date_end" >
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
        $(document).ready(function(){
            var city_id = "{{$data->city_id}}";
            axios.get("{{url('/dashboard/states/list-city-by-id')}}" + '/' + $('#state_id').val())
            .then(function(response) {
                var options = '<option value="">Selecione</option>';
                for (var i = 0; i < response.data.length; i++) {
                    var selected = (parseInt(city_id) === parseInt(response.data[i].id) ? 'selected' : '');
                    options += '<option value="' +
                    response.data[i].id + `"${selected}>` +
                    response.data[i].name + '</option>';
                }
                $('#city_id').html(options);
            })
            .catch(function(error){
                console.log(error);
            });
        });

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