@extends('adminlte::page')

@section('title', 'Cadastro de Paciente')

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
                <div class="col-sm-4">
                    <label for="nome">Nome</label>
                    <input type="text" value="" name="nome" class="form-control"
                           required>
                </div>
                <div class="col-sm-4">
                    <label>Status</label>
                    <select class="form-control" name="sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="nome">Data de Nascimento</label>
                    <input type="date" value="" name="data_nascimento" class="form-control"
                           required>
                </div>

            </div>


            <div class=" row">
                <div class="col-sm-3">
                    <label for="telefone">Telefone</label>
                    <input type="text" value="" name="telefone" class="form-control"
                           required>
                </div>

                <div class="col-sm-3">
                    <label for="cpf">CPF</label>
                    <input type="text" value="" name="cpf" class="form-control"
                           required>
                </div>

                <div class="col-sm-3">
                    <label>Plano</label>
                    <select class="form-control" name="plano_id">
                        @foreach($planos as $plano)
                            <option @if((int) old('id') === $plano->id) selected
                                    @endif value="{{ $plano->id }}">{{ $plano->nome_plano }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="hidden" name="data_entrada" value="{{ date('Y-m-d h:i:s') }}">

            <div class="form-group">
                <button type="submit" class="btn btn-danger">Salvar Paciente</button>
            </div>
        </div>
    </form>

    <h2>Lista de Pacientes</h2>
    <div class="box-body">
        @if($pacientes)
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Data de Entrada</th>
                    <th>Plano</th>
                    <th>Ações</th>
                <tr>
                </thead>
                <tbody>
                @foreach($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->id }}</td>
                        <td>{{ $paciente->pessoa->nome }}</td>
                        <td>{{ $paciente->data_entrada }}</td>
                        <td>{{ $paciente->plano->nome_plano }}</td>
                        <td style="display: inline-flex;">
                            <a class="btn btn-primary"
                               href="{{ route('paciente.edit', $paciente->id) }}">Editar</a>
                            <form action="{{ route('paciente.destroy', $paciente->id) }}" method="POST">
                                {{ method_field('DELETE') }}{{csrf_field()}}
                                <a onclick="return confirm('Deseja realmente deletar o paciente {{  $paciente->pessoa->nome  }}?')? this.parentNode.submit() : void(0);"
                                   class="btn btn-info">Apagar
                                </a>
                            </form>
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Não há pacientes cadastrados</p>
        @endif
    </div>
@stop
