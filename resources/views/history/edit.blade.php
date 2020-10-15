@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edição - Loja</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <br />
            @include('helpers.messages')
            <form method="POST" action="{{url('/dashboard/stores/update/'.$data->id)}}">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="information">Marca <span class="required">*</span></label>
                    <select name="brand_id" value="{{$data->brand_id}}" class="form-control" id="brand_id">
                        <option value="">Selecione</option>
                        @foreach($brands as $bra)
                            @if ($data->brand_id === $bra->id)
                                <option value="{{$bra->id}}" selected>{{$bra->name}}</option>
                            @else
                                <option value="{{$bra->id}}">{{$bra->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="information">Informações <span class="required">*</span></label>
                    <textarea name="information" class="form-control" id="information">{{$data->information}}</textarea>
                </div>
                <div class="form-group">
                    <label for="address">Endereço <span class="required">*</span></label>
                    <input name="address"  value="{{$data->address}}" type="text" class="form-control" id="address" placeholder="Endereço">
                </div>
                <div class="row">
                <div class="col">
                        <label for="state_id">Estados <span class="required">*</span></label>
                        {{$data->state_id}}
                        <select name="state_id" value="{{$data->state_id}}" class="form-control" id="state_id">
                            <option value="">Selecione</option>
                            @foreach($states as $sta)
                                @if ($data->state_id === $sta->id)
                                    <option value="{{$sta->id}}" selected>{{$sta->name}}</option>
                                @else
                                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="city_id">Cidade <span class="required">*</span></label>
                        {{$data->city_id}}
                        <select name="city_id" value="{{$data->city_id}}" type="city" class="form-control" id="city_id">
                        </select>
                    </div>
                    <div class="col">
                        <label for="lat">Latitude <span class="required">*</span></label>
                        <input name="lat" value="{{$data->lat}}"  type="text" class="form-control" id="lat" placeholder="-13.929354846">
                    </div>
                    <div class="col">
                        <label for="lng">Longitude <span class="required">*</span></label>
                        <input name="lng" value="{{$data->lng}}" type="text" class="form-control" id="lng" placeholder="-9.98584184">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6">
                    <a href="{{url('/dashboard/stores')}}" class="btn btn-warning">Cancelar</a>
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
        $(document).ready(function() {
            var state_id = $("#state_id").val();
            var city_id = "{{$data->city_id}}";
            axios.get("{{url('/dashboard/states/list-city-by-id')}}" + '/' + state_id)
            .then(function(response) {
                var options = '<option value="">Selecione</option>';
                for (var i = 0; i < response.data.length; i++) {
                    var selected  = city_id === `${response.data[i].id}` ? 'selected' : '';
                    options += `<option value="` +
                    response.data[i].id + `" ${selected}>` +
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
                var options = '<option value=""></option>';
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