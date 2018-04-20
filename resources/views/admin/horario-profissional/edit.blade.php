@extends('adminlte::page')

@section('title', 'Atualizar Horários dos profissionais')

@section('content_header')
    <h1>Atualizar Horários dos profissionais</h1>
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



    <form method="POST" action="{{url('horario-profissional', [$horario->id])}}">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}

        <div class="form-group">
            <div class=" row">
                <div class="col-sm-3">
                    <label for="dia_semana">Dia da Semana</label>
                    <select class="form-control" name="dia_semana">
                        @foreach( $dia_semana as $chave => $valor )
                            <option @if((int) $horario->dia_semana == $chave) selected
                                    @endif value="{{ $chave }}">{{ $valor }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="descricao">Horário Inicio</label>
                    <div class="input-group">
                        <input type="text" value="{{  $horario->horario_inicio }}" name="horario_inicio" id="horario_inicio"
                               class="form-control" minlength="8" required>

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>

                </div>
                <div class="col-sm-3">
                    <label for="descricao">Horário Final</label>
                    <div class="input-group">
                        <input type="text" value="{{  $horario->horario_final }}" name="horario_final" id="horario_final"
                               class="form-control" minlength="8" required>
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <label for="quantidade_consultas">Quantidade de consultas</label>
                    <input type="text" value="{{  $horario->quantidade_consultas }}" name="quantidade_consultas"
                           class="form-control" maxlength="2" required>
                </div>

            </div>
            <div class=" row">

                <div class="col-sm-4">
                    <label for="profissional_id">Profissional</label>
                    <select class="form-control" name="profissional_id">
                        @foreach($profissionais as $profissional)
                            <option @if((int) $horario->profissional_id === $profissional->id) selected
                                    @endif value="{{ $profissional->id }}">{{ $profissional->pessoas->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Atualizar Profissão</button>
        </div>
    </form>

@stop