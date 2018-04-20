@extends('adminlte::page')

@section('title', 'Cadastro de Agendas dos profissionais')

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
        @csrf
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-4">
                    <label for="nome">Data de agendamento</label>
                    <input type="date" value="" name="data_agendamento" class="form-control"
                           required>
                </div>
                <div class="col-sm-4">
                    <label for="descricao">Horário Inicio</label>
                    <div class="input-group">
                        <input type="text" name="horario_inicial" class="form-control timepicker">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">
                    <label for="descricao">Horário Final</label>
                    <input type="text" value="" name="horario_final" class="form-control"
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
                    <label>Profissional</label>
                    <select class="form-control" name="profissional_id">
                        @foreach($profissionais as $profissional)
                            <option @if((int) old('id') === $profissional->id) selected
                                    @endif value="{{ $profissional->id }}">{{ $profissional->pessoas->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label>Paciente</label>
                    <select class="form-control" name="paciente_id">
                        @foreach($pacientes as $paciente)
                            <option @if((int) old('id') === $paciente->id) selected
                                    @endif value="{{ $paciente->id }}">{{ $paciente->pessoa->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class=" row">
                <div class="col-sm-12">
                    <label>Observação</label>
                    <textarea class="form-control" name="obs" rows="3">{{ old('obs') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Salvar Agendamento</button>
        </div>
    </form>

    <h2>Lista de Agendamentos dos profissionais</h2>
    <div class="box-body">
        @if($agendas)
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Data do Agendamento</th>
                    <th>Horário de Inicio</th>
                    <th>Horário Final</th>
                    <th>Status</th>
                    <th>Profissional</th>
                    <th>Paciente</th>
                    <th>Ações</th>
                <tr>
                </thead>
                <tbody>
                @foreach($agendas as $agenda)
                    <tr>
                        <td>{{ $agenda->id }}</td>
                        <td>{{ Carbon\Carbon::parse($agenda->data_agendamento)->format('d/m/Y') }}</td>
                        <td>{{ $agenda->horario_inicial }}</td>
                        <td>{{ $agenda->horario_final }}</td>
                        <td>{{ $agenda->status_agendamento }}</td>
                        <td>{{ $agenda->profissional_id }}</td>
                        <td>{{ $agenda->paciente_id }}</td>
                        <td style="display: inline-flex;">
                            <a class="btn btn-primary" href="{{ route('agenda.edit', $agenda->id) }}">Editar</a>
                            <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST">
                                @csrf {{ method_field('DELETE') }}
                                <a onclick="return confirm('Deseja realmente deletar o agendamento de {{  Carbon\Carbon::parse($agenda->data_agendamento)->format('d/m/Y')  }}?')? this.parentNode.submit() : void(0);"
                                   class="btn btn-info">Apagar
                                </a>
                            </form>
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Não há agendamentos cadastrados</p>
        @endif
    </div>

@stop
