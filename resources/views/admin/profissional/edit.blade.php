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


    <form method="POST" action="{{url('profissional', [$profissional->id])}}">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}

        <div class="form-group">
            <div class=" row">
                <div class="col-sm-4">
                    <label for="dia_semana">Dia da Semana</label>
                    <select class="form-control" name="dia_semana">
                        <option value="1">Segunda</option>
                        <option value="2">Terça</option>
                        <option value="3">Quarta</option>
                        <option value="4">Quinta</option>
                        <option value="5">Sexta</option>
                        <option value="6">Sábado</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="horario_inicio">Horário Inicio</label>
                    <div class="input-group">
                        <input type="text" value="{{  $horario->horario_inicio }}" name="horario_inicio"
                               class="form-control timepicker">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">
                    <label for="horario_final">Horário Final</label>
                    <input type="text" value="{{  $horario->horario_final }}" name="horario_final" class="form-control"
                           required>
                </div>

            </div>
            <div class=" row">
                <div class="col-sm-6">
                    <label for="quantidade_consultas">Quantidade de consultas</label>
                    <input type="text" value="{{  $horario->quantidade_consultas }}" name="quantidade_consultas"
                           class="form-control" required>
                </div>
                <div class="col-sm-6">
                    <label for="profissional_id">Profissional</label>
                    <input type="text" value="{{  $horario->profissional_id }}" name="profissional_id"
                           placeholder="Descrição"
                           class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Atualizar Profissão</button>
        </div>
    </form>


@stop