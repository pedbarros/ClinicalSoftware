@extends('adminlte::page')

@section('title', 'Atualizar Profissão - Clínica Software')

@section('content_header')
    <h1>Atualizar de profissões</h1>
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

    {{-- json_encode($profissao) --}}

    <form method="POST" action="{{ url('profissao', [$profissao->id] )}}">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-3">
                    <label for="name">Nome</label>
                    <input type="text" value="{{  $profissao->descricao }}" name="descricao" class="form-control" maxlength="50" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Atualizar Profissão</button>
        </div>
    </form>

@stop