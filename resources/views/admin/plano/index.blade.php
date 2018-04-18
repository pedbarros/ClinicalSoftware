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
                    <input type="text" value="" name="nome_plano" placeholder="Plano de Saúde" class="form-control" required>
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
        @if($planos)
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
                @foreach($planos as $plano)
                    <tr>
                        <td>{{ $plano->id }}</td>
                        <td>{{ $plano->nome_plano }}</td>
                        <td>{{ $plano->status }}</td>
                        <td style="display: inline-flex;">
                            <a class="btn btn-primary" href="{{ route('plano.edit', $plano->id) }}">Editar</a>
                            <form action="{{ route('plano.destroy', $plano->id) }}" method="POST">
                                {{ method_field('DELETE') }}{{csrf_field()}}
                                <a onclick="return confirm('Deseja realmente deletar o plano {{  $plano->nome_plano  }}?')? this.parentNode.submit() : void(0);"
                                   class="btn btn-info">Apagar
                                </a>
                            </form>
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Não há planos cadastrados</p>
        @endif
    </div>
@stop