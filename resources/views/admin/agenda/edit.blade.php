@extends('adminlte::page')

@section('title', 'Atualizar Agendas dos profissionais')

@section('content_header')
    <h1>Atualizar agendas dos profissionais</h1>
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

    <form method="POST" action="{{url('agenda', [$agenda->id])}}">
        @csrf
        {{ method_field('PUT') }}

        <div class="form-group">
            <div class=" row">
                <div class="col-sm-4">
                    <label for="nome">Data de agendamento</label>
                    <input type="date" value="{{ Carbon\Carbon::parse($agenda->data_agendamento)->format('Y-m-d') }}" name="data_agendamento"
                           class="form-control" required>
                </div>
                <div class="col-sm-4">
                    <label for="descricao">Horário Inicio</label>
                    <div class="input-group">
                        <input type="text" value="{{ $agenda->horario_inicial  }}" name="horario_inicial"
                               class="form-control timepicker">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">
                    <label for="descricao">Horário Final</label>
                    <input type="text" value="{{ $agenda->horario_final  }}" name="horario_final" class="form-control"
                           required>
                </div>

            </div>
            <div class=" row">
                <div class="col-sm-4">
                    <label>Status Agendamento</label>
                    <select class="form-control" name="status_agendamento">
                        <option value="C">Concluído</option>
                        <option value="F">Faltou</option>
                        <option value="X">Cancelado</option>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label>Paciente</label>
                    <select class="form-control" name="paciente_id">
                        @foreach($pacientes as $paciente)
                            <option @if((int) $agenda->paciente_id === $paciente->id) selected
                                    @endif value="{{ $paciente->id }}">{{ $paciente->pessoa->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <label>Profissional</label>
                    <select class="form-control" name="profissional_id">
                        @foreach($profissionais	 as $profissional)
                            <option @if((int) $agenda->profissional_id === $profissional->id) selected
                                    @endif value="{{ $profissional->id }}">{{ $profissional->pessoas->nome }}</option>
                        @endforeach
                    </select>
                </div>

            </div>


            <div class=" row">
                <div class="col-sm-12">
                    <label>Observação</label>
                    <textarea class="form-control" name="obs" rows="3">{{ $agenda->obs  }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Atualizar Agendamento</button>
        </div>
    </form>


@stop