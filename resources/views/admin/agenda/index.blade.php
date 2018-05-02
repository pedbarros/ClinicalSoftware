@extends('adminlte::page')

@section('title', 'Lista de agendamentos')

@section('content')


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Agendamentos dos profissionais</h3>

                    <form class="form form-inline" action="{{ route('agenda.search') }}" method="POST">
                        @csrf
                        <input type="date" value="{{ old('data_agendamento') }}" name="data_agendamento" class="form-control">

                        <select class="form-control" name="profissional_id">
                            <option value="">Selecione o Profissional</option>
                            @foreach($profissionais as $profissional)
                                <option @if((int) old('profissional_id') === $profissional->id) selected
                                        @endif value="{{ $profissional->id }}">{{ $profissional->pessoas->nome}}</option>
                            @endforeach
                        </select>


                        <select class="form-control" name="paciente_id">
                            <option value="">Selecione o Paciente</option>
                            @foreach($pacientes as $paciente)
                                <option @if((int) old('paciente_id') === $paciente->id) selected
                                        @endif value="{{ $paciente->id }}">{{ $paciente->pessoas->nome}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </form>
                    <button type="button" id="btnClearTable" class="btn btn-primary">Pesquisar</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

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
                            <tbody id="conteudoDaTabela">
                            @foreach($agendas as $agenda)
                                <tr>
                                    <td>{{ $agenda->id }}</td>
                                    <td>{{ Carbon\Carbon::parse($agenda->data_agendamento)->format('d/m/Y') }}</td>
                                    <td>{{ $agenda->horario_inicial }}</td>
                                    <td>{{ $agenda->horario_final }}</td>
                                    <td>{{ $agenda->status_agendamento }}</td>
                                    <td>{{ $agenda->profissional->pessoas->nome }}</td>
                                    <td>{{ $agenda->paciente->pessoas->nome }}</td>
                                    <td style="display: inline-flex;">
                                        <a class="btn btn-primary"
                                           href="{{ route('agenda.edit', $agenda->id) }}">Editar</a>
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
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                var tokenAPI = {!! json_encode( session('token') ) !!};


                $('#btnClearTable').on('click', function () {
                    $("#conteudoDaTabela").empty();

                    $.ajax({
                        url: '/api/search-agenda/',
                        method: "POST",
                        // data: { 'dia_semana': diaDaSemana },
                        headers: {"Authorization": "Bearer " + tokenAPI},
                        success: (data) => {
                            // console.log(data)
                            $.each(data, function (i, elem) {
                                var a = "@include('admin.includes.alerts')";

                                $("#conteudoDaTabela")
                                    .append("<tr><td>"+elem.id+"</td><td>"+moment(elem.data_agendamento).format('DD/MM/YYYY')+"</td>   " +
                                        "<td>"+elem.horario_inicial+"</td><td>"+elem.horario_final+"</td>" +
                                        "<td>"+elem.status_agendamento+"</td><td>"+elem.profissional.pessoas.nome+"</td>" +
                                        "<td>"+elem.paciente.pessoas.nome+"</td>"+

                                        "<td style='display: inline-flex;'><a class='btn btn-primary' href='/agenda/" + elem.id + "/edit'>Editar</a>"+
                                        /*"<form action='agenda/' method='POST'>" +
                                        " <a onclick='return confirm('Deseja realmente deletar o agendamento de?')? this.parentNode.submit() : void(0);'" +
                                        " class='btn btn-info'>Apagar </a> </form></td>"+*/
                                        "</tr>");
                            });
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert("Ocorreu um erro: " + thrownError);
                        }
                    });
                });
            });
        </script>
    @endpush
@stop
