@extends('adminlte::page')

@section('title', 'Cadastro de Especialidade - Clínica Software')

@section('content_header')
    <h1>Cadastro de Especialidades</h1>
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
                        <label for="name">Nome</label>
                        <input type="text" value="{{  old('nome') }}" name="nome" placeholder="Nome" class="form-control" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="name">Descrição</label>
                        <input type="text" value="{{ old('descricao') }}" name="descricao" placeholder="Descrição" class="form-control" required>
                    </div>
                </div>
            </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Salvar Especialidade</button>
        </div>
    </form>

    <h2>Lista de Especialidades</h2>
    <div class="box-body">
        @if($especialidades)
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                <tr>
                </thead>
                <tbody>
                @forelse($especialidades as $especialidade)
                    <tr>
                        <td>{{ $especialidade->id }}</td>
                        <td>{{ $especialidade->nome }}</td>
                        <td>{{ $especialidade->descricao }}</td>
                        <td style="display: inline-flex;">
                            <a class="btn btn-primary" href="{{ route('especialidade.edit', $especialidade->id) }}">Editar</a>
                            <form action="{{ route('especialidade.destroy', $especialidade->id) }}" method="POST">
                                {{ method_field('DELETE') }}{{csrf_field()}}
                                <a onclick="return confirm('Deseja realmente deletar a especialidade {{  $especialidade->nome  }}?')? this.parentNode.submit() : void(0);"
                                   class="btn btn-info">Apagar
                                </a>
                            </form>
                        </td>
                    <tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Não há especialidades cadastradas</p>
        @endif
    </div>
@stop