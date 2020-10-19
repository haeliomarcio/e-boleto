@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Clientes</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @include('helpers.form-search')
                </div>
                <div class="col-md-6 text-right">
                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-warning">Enviar Boletos</button>
                    &nbsp;
                    <a href="{{url('/clients/carregar-clientes')}}" class="btn btn-primary">Carregar Clientes</a>
                    &nbsp;
                    <a href="{{url('/clients/create')}}" class="btn btn-success">Novo Cliente</a>
                </div>
            </div>
            <br />
            @include('helpers.messages')
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 10px">#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th style="width: 40px">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <input class="select-client" type="checkbox" name="clients[]" value="{{$item->id}}" />
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td style="width: 180px;" class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{url('/clients/edit/'.$item->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Editar
                                </a>
                                <a id="confirmation-delete" data-info="{{url('/clients/delete/'.$item->id)}}" class="btn btn-danger btn-sm" href="#">
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
    <div class="modal-dialog modal-lg">...</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Enviar Boletos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="required">Competência</label>
                        <input id="competencia" class="form-control" type="month" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="required">Mensagem</label>
                        <textarea id="mensagem" rows="4" class="form-control" ></textarea>
                    </div>
                </div>
                <div id="loader" style="text-align: center;">
                    <img src="{{url('images/loader.gif')}}" width="100px"/>
                    <br />
                    Enviando...
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" id="enviarBoletos"  class="btn btn-success">Processar Envio</button>
        </div>
        </div>
    </div>
    </div>
@endsection 
@section('scripts')
    <script>
        var listClients = [];
       
        $(".select-client").change(function() {
            var id = $(this).val();
            if($(this).prop('checked')) {
                listClients.push(id);
            } else {
                var idx = listClients.indexOf(id);
                if(idx != -1) {
                    listClients.splice(idx, 1);
                }
            }
        });

        $("#loader").css('display', 'none');
        $("#enviarBoletos").click(function() {
            var crsf = "<?php echo csrf_token(); ?>";
            var competencia = $("#competencia").val();
            var mensagem = $("#mensagem").val();
            
            if(!competencia) {
                Swal.fire({
                    icon: 'question',
                    title: 'Atenção',
                    text: 'Informe a Competência',
                });
                return false;
            }
            $("#loader").css('display', 'block');

            $.ajax({
                type: 'POST',
                url: "/boletos/enviar-boletos",
                data: { 
                    'competencia': competencia, 
                    'crsf_token': crsf, 
                    'mensagem': mensagem,
                    'clients': listClients,
                },
                headers: {
                    'X-CSRF-TOKEN': crsf
                },
                success: function (result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Boletos enviados com sucesso!',
                        footer: 'Verifique em Históricos de Envio para analisar todos os sucessos de envios.'
                    });
                    $("#loader").css('display', 'none');
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Atenção',
                        text: response.responseJSON.message,
                    });
                    $("#loader").css('display', 'none');
                }
            }).done(function() {
                
            });
        });
    </script>
@endsection