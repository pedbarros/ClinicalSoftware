@extends('adminlte::page')

@section('title', 'Atualizar Profissional')

@section('content_header')
    <h1>Atualizar Profissional</h1>
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

{{$profissional->pessoas}}
    <form action="{{ url('profissional', [$profissional->id])}}" method="POST">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-4">
                    <label for="nome">Nome</label>
                    <input type="text" value="{{  $profissional->pessoas->nome }}" name="nome" class="form-control"
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
                    <input type="date" value="{{  $profissional->pessoas->data_nascimento }}" name="data_nascimento" class="form-control"
                           required>
                </div>

            </div>


            <div class=" row">
                <div class="col-sm-3">
                    <label for="telefone">Telefone</label>
                    <input type="text" value="{{  $profissional->pessoas->telefone }}" name="telefone" class="form-control"
                           required>
                </div>

                <div class="col-sm-3">
                    <label for="cpf">CPF</label>
                    <input type="text" value="{{  $profissional->pessoas->cpf }}" name="cpf" class="form-control"
                           required>
                </div>

                <div class="col-sm-3">
                    <label for="cpf">Cód. Conselho</label>
                    <input type="text" value="{{  $profissional->cod_conselho }}" name="cod_conselho" class="form-control"
                           required>
                </div>

                <div class="col-sm-3">
                    <label>Especialidade</label>
                    <select class="form-control" name="especialidade_id">
                        @foreach($especialidades as $especialidade)
                            <option @if((int) $profissional->id === $especialidade->id) selected
                                    @endif value="{{ $especialidade->id }}">{{ $especialidade->nome }}</option>
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