@extends('adminlte::page')

@section('title', 'Atualizar Plano - Clínica Software')

@section('content_header')
    <h1>Atualizar de planos</h1>
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


    <form method="POST" action="{{url('plano', [$plano->id])}}">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-3">
                    <label for="nome_plano">Nome do Plano</label>
                    <input type="text" value="{{  $plano->nome_plano }}" name="nome_plano" class="form-control" maxlength="50" required>
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
            <button type="submit" class="btn btn-danger">Atualizar Plano</button>
        </div>
    </form>


@stop