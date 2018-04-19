@extends('adminlte::page')

@section('title', 'Atualizar Paciente')

@section('content_header')
    <h1>Atualizar Paciente</h1>
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

    {{$paciente->pessoas}}
    <form action="{{ url('paciente', [$paciente->id])}}" method="POST">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-4">
                    <label for="nome">Nome</label>
                    <input type="text" value="{{  $paciente->pessoa->nome }}" name="nome" class="form-control"
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
                    <input type="date" value="{{  $paciente->pessoa->data_nascimento }}" name="data_nascimento" class="form-control"
                           required>
                </div>

            </div>


            <div class=" row">
                <div class="col-sm-3">
                    <label for="telefone">Telefone</label>
                    <input type="text" value="{{  $paciente->pessoa->telefone }}" name="telefone" class="form-control"
                           required>
                </div>

                <div class="col-sm-3">
                    <label for="cpf">CPF</label>
                    <input type="text" value="{{  $paciente->pessoa->cpf }}" name="cpf" class="form-control"
                           required>
                </div>

                <div class="col-sm-3">
                    <label>Plano</label>
                    <select class="form-control" name="plano_id">
                        @foreach($planos as $plano)
                            <option @if((int) $paciente->plano->id === $plano->id) selected
                                    @endif value="{{ $plano->id }}">{{ $plano->nome_plano }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="hidden" name="data_entrada" value="{{ date('Y-m-d h:i:s') }}">

            <div class="form-group">
                <button type="submit" class="btn btn-danger">Salvar</button>
            </div>
        </div>
    </form>


@stop