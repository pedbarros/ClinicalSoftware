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
                        <label for="name">Nome</label>
                        <input type="text" value="Enfermeira" name="descricao" placeholder="Descrição" class="form-control">
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
                <th>Status</th>
                <th>Ações</th>
            <tr>
            </thead>
            <tbody>
            @forelse($profissoes as $profissao)
                <tr>
                    <td>{{ $profissao->id }}</td>
                    <td>{{ $profissao->descricao }}</td>
                    <td>{{ $profissao->status }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('profissao.edit', $profissao->id) }}">Editar</a>
                        <a class="btn btn-info" href="{{ route('profissao.destroy', $profissao->id) }}">Deletar</a>
                    </td>
                <tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
@stop