@extends('adminlte::page')

@section('title', 'Adicionar um plano a um profissional')

@section('content_header')
    <h1>Adicionar um plano a um profissional</h1>
@stop

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif




    <form action="" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-3">
                    <label>Plano</label>
                    <select class="form-control" name="plano_id" id="plano_id">
                        @foreach($planos as $plano)
                            <option @if((int) old('id') === $plano->id) selected
                                    @endif value="{{ $plano->id }}">{{ $plano->nome_plano }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label>Profissional</label>
                    <select class="form-control" name="profissional_id" id="profissional_id">
                        @foreach($profissionais as $profissional)
                            <option @if((int) old('id') === $profissional->id) selected
                                    @endif value="{{ $profissional->id }}">{{ $profissional->pessoas->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-3">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="A">Ativo</option>
                        <option value="I">Inativo</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Adicionar</button>
        </div>
    </form>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Profissionais</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    @if($profissionais)
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Cód. Conselho</th>
                                <th>Nome</th>
                                <th>Data de Entrada</th>
                                <th>Especialidade</th>
                                <th>Ações</th>
                            <tr>
                            </thead>
                            <tbody>
                            @foreach($profissionais as $profissional)
                                <tr>
                                    <td>{{ $profissional->id }}</td>
                                    <td>{{ $profissional->cod_conselho }}</td>
                                    <td>{{ $profissional->pessoas->nome }}</td>
                                    <td>{{ $profissional->data_entrada }}</td>
                                    <td>{{ $profissional->especialidades->nome }}</td>
                                    <td style="display: inline-flex;">
                                        <button type="button" class="btn btn-danger btnMostrarPlano"
                                                onclick="mostrarDetalhesDoProfissional({{json_encode($profissional)}})">
                                            Mostrar planos
                                        </button>
                                    </td>
                                <tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Não há profissionais cadastrados</p>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="modal fade" id="modal-planos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Planos</h2>
                </div>
                <div class="modal-body">
                    <div id="conteudo"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var tokenAPI = {!! json_encode(session('token')) !!};

            function mostrarDetalhesDoProfissional(profissional) {
                // console.log(profissional.planos)
                var conteudoModal = document.getElementById('conteudo');
                conteudoModal.innerHTML = '';
                if (profissional.planos.length == 0)
                    conteudoModal.innerHTML = "Profissional sem plano vinculado";
                profissional.planos.forEach(function (valor, _) {
                    conteudoModal.innerHTML += '- <b>' + valor.nome_plano + '</b><br>'
                });

                $("#modal-planos").modal();
            }

            $('#plano_id, #profissional_id').select2();

            $("#modal-planos").on("hidden.bs.modal", function () {
                $.ajax({
                    url: "/api/profissional/",
                    headers: {"Authorization": "Bearer " + tokenAPI},
                    success: function (data) {
                        console.log(data)
                    },
                    error: function (err) {
                    }

                });

                // $("#profissional_id").empty();

            });
        </script>
    @endpush
@stop