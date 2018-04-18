@extends('adminlte::page')

@section('title', 'Cadastro de Profissão - Clínica Software')

@section('content_header')
    <h1>Cadastro de profissões</h1>
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
                    <label for="descricao">Nome</label>
                    <input type="text" value="Enfermeira" name="descricao" placeholder="Descrição" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Salvar Profissão</button>
        </div>
    </form>

    <h2>Lista de profissões</h2>
    <div class="box-body">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Descrição</th>
                <th>Ações</th>
            <tr>
            </thead>
            <tbody>
            @forelse($profissoes as $profissao)
                <tr>
                    <td>{{ $profissao->id }}</td>
                    <td>{{ $profissao->descricao }}</td>
                    <td style="display: inline-flex;">
                        <a class="btn btn-primary" href="{{ route('profissao.edit', $profissao->id) }}">Editar</a>
                        <form action="{{ route('profissao.destroy', $profissao->id) }}" method="POST">
                            {{ method_field('DELETE') }}{{csrf_field()}}
                            <a onclick="return confirm('Deseja realmente deletar a profissão {{  $profissao->descricao  }}?')? this.parentNode.submit() : void(0);"
                               class="btn btn-info">Apagar
                            </a>
                        </form>
                    </td>
                <tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
@stop