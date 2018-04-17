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
                        <input type="text" value="{{  old('nome') }}" name="nome" placeholder="Nome" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <label for="name">Descrição</label>
                        <input type="text" value="{{ old('descricao) }}" name="descricao" placeholder="Descrição" class="form-control">
                    </div>
                </div>
            </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Salvar Especialidade</button>
        </div>
    </form>

    <h2>Lista de Especialidades</h2>
    <div class="box-body">
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
                    <td>
                        <a class="btn btn-primary" href="{{ route('especialidade.edit', $especialidade->id) }}">Editar</a>
                        <a class="btn btn-info" href="{{ route('especialidade.destroy', $especialidade->id) }}">Deletar</a>
                    </td>
                <tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
@stop