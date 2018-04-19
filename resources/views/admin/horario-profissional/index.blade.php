@extends('adminlte::page')

@section('title', 'Cadastro de Horários dos profissionais')

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
                <div class="col-sm-4">
                    <label for="descricao">Dia da Semana</label>
                    <input type="text" value="" name="dia_semana" class="form-control"
                           required>
                </div>
                <div class="col-sm-4">
                    <label for="descricao">Horário Inicio</label>
                    <div class="input-group">
                        <input type="text" name="horario_inicio" class="form-control timepicker">

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
                <div class="col-sm-6">
                    <label for="descricao">Quantidade de consultas</label>
                    <input type="text" value="" name="quantidade_consultas" class="form-control" required>
                </div>
                <div class="col-sm-6">
                    <label for="descricao">Profissional</label>
                    <input type="text" value="" name="profissional_id" placeholder="Descrição"
                           class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Salvar Horário</button>
        </div>
    </form>

    <h2>Lista de Horários dos profissionais</h2>
    <div class="box-body">
        @if($horarios)
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Dia da Semana</th>
                    <th>Horario de Inicio</th>
                    <th>Horario Final</th>
                    <th>Quantidade de consultas</th>
                    <th>Profissional</th>
                    <th>Ações</th>
                <tr>
                </thead>
                <tbody>
                @foreach($horarios as $horario)
                    <tr>
                        <td>{{ $horario->id }}</td>
                        <td>{{ $horario->dia_semana }}</td>
                        <td>{{ $horario->horario_inicio }}</td>
                        <td>{{ $horario->horario_final }}</td>
                        <td>{{ $horario->quantidade_consultas }}</td>
                        <td>{{ $horario->profissional_id }}</td>
                        <td style="display: inline-flex;">
                            <a class="btn btn-primary" href="{{ route('horario-profissional.edit', $horario->id) }}">Editar</a>
                            <form action="{{ route('horario-profissional.destroy', $horario->id) }}" method="POST">
                                {{ method_field('DELETE') }}{{csrf_field()}}
                                <a onclick="return confirm('Deseja realmente deletar o horário {{  $horario->dia_semana  }}?')? this.parentNode.submit() : void(0);"
                                   class="btn btn-info">Apagar
                                </a>
                            </form>
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Não há horários cadastrados</p>
        @endif
    </div>
@stop
