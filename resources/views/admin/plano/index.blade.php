@extends('adminlte::page')

@section('title', 'Cadastro de Planos - Clínica Software')

@section('content_header')
    <h1>Cadastro de planos</h1>
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
                        <label for="nome_plano">Nome do Plano</label>
                        <input type="text" value="" name="nome_plano" placeholder="Plano de Saúde" class="form-control">
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
            <button type="submit" class="btn btn-danger">Salvar Plano</button>
        </div>
    </form>

    <h2>Lista de Planos</h2>
    <div class="box-body">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome do Plano</th>
                <th>Status</th>
                <th>Ações</th>
            <tr>
            </thead>
            <tbody>
            @forelse($planos as $plano)
                <tr>
                    <td>{{ $plano->id }}</td>
                    <td>{{ $plano->nome_plano }}</td>
                    <td>{{ $plano->status }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('plano.edit', $plano->id) }}">Editar</a>
                        <a class="btn btn-info" href="{{ route('plano.destroy', $plano->id) }}">Deletar</a>
                    </td>
                <tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
@stop