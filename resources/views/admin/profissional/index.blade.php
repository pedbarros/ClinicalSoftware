@extends('adminlte::page')

@section('title', 'Cadastro de Profissional')

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
                    <input type="text" value="" name="data_nascimento" class="form-control"
                           required>
                </div>

            </div>



            <div class=" row">
                <div class="col-sm-4">
                    <label for="telefone">Telefone</label>
                    <input type="text" value="" name="telefone" class="form-control"
                           required>
                </div>

                <div class="col-sm-4">
                    <label for="cpf">CPF</label>
                    <input type="text" value="" name="cpf" class="form-control"
                           required>
                </div>

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-danger">Salvar</button>
            </div>
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
                            <a class="btn btn-primary" href="{{ route('profissional.edit', $profissional->id) }}">Editar</a>
                            <form action="{{ route('profissional.destroy', $profissional->id) }}" method="POST">
                                {{ method_field('DELETE') }}{{csrf_field()}}
                                <a onclick="return confirm('Deseja realmente deletar o profissional {{  $profissional->pessoas->nome  }}?')? this.parentNode.submit() : void(0);"
                                   class="btn btn-info">Apagar
                                </a>
                            </form>
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Não há profissionais cadastrados</p>
        @endif
    </div>
@stop
