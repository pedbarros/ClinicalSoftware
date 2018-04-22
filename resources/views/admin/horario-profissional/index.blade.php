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
                <div class="col-sm-3">
                    <label for="descricao">Dia da Semana</label>
                    <select class="form-control" name="dia_semana">
                        @foreach( $dia_semana as $chave => $valor )
                            <option value="{{$chave}}">{{$valor}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="descricao">Horário Inicio</label>
                    <div class="input-group">
                        <input type="text" value="" name="horario_inicio" id="horario_inicio"
                               class="form-control" minlength="8" required>

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>

                </div>
                <div class="col-sm-3">
                    <label for="descricao">Horário Final</label>
                    <div class="input-group">
                        <input type="text" value="" name="horario_final" id="horario_final"
                               class="form-control" minlength="8" required>
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <label for="descricao">Quantidade de consultas</label>
                    <input type="text" value="" name="quantidade_consultas" class="form-control" maxlength="2" required>
                </div>

            </div>
            <div class=" row">
                <div class="col-sm-4">
                    <label>Profissional</label>
                    <select class="form-control" name="profissional_id" id="profissional_id">
                        @foreach($profissionais as $profissional)
                            <option @if((int) old('id') === $profissional->id) selected
                                    @endif value="{{ $profissional->id }}">{{ $profissional->pessoas->nome}}</option>
                        @endforeach
                    </select>
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
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#profissional_id').select2();
                $('#horario_inicio, #horario_final').mask('99:99:99');
            });
        </script>
    @endpush
@stop
