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
                    <select class="form-control" name="plano_id">
                        @foreach($planos as $plano)
                            <option @if((int) old('id') === $plano->id) selected
                                    @endif value="{{ $plano->id }}">{{ $plano->nome_plano }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label>Profissional</label>
                    <select class="form-control" name="profissional_id">
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
            <button type="submit" class="btn btn-danger">Salvar</button>
        </div>
    </form>


    <h2>Lista de Profissionais</h2>
    <div class="box-body">
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
                            <button type="button" id="btnMostrarPlano" class="btn btn-danger" data-toggle="modal" data-target="#modal-planos" data-profissional="{{ json_encode($profissional) }}">
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

    <div class="modal fade" id="modal-planos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Planos</h2>
                </div>
                <div class="modal-body">
                    <p>Unimed Maceió</p>
                    <p>Smile Saúde</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('#modal-planos').on('shown.bs.modal', function (e) {
                var data = document.getElementById('btnMostrarPlano');
                var json = JSON.parse(data.getAttribute('data-profissional'));
                console.log(json);
            })
        </script>
    @endpush
@stop