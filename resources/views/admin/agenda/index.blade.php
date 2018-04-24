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
                    <label for="data_agendamento">Data de agendamento</label>
                    <input type="date" value="" name="data_agendamento" id="data_agendamento" class="form-control"
                           required>
                </div>
                <div class="col-sm-4">
                    <label for="horario">Horário Final</label>
                    <select class="form-control" name="horario" id="horario"></select>
                </div>

            </div>
            <div class=" row">
                <!-- <div class="col-sm-4">
                     <label>Status Agendamento</label>
                     <select class="form-control" name="status_agendamento">
                         <option value="C">Concluído</option>
                         <option value="F">Faltou</option>
                         <option value="X">Cancelado</option>
                     </select>
                 </div> -->
                <div class="col-sm-4">
                    <label>Profissional</label>
                    <select class="form-control" name="profissional_id" id="profissional_id">
                        @foreach($profissionais as $profissional)
                            <option @if((int) old('id') === $profissional->id) selected
                                    @endif value="{{ $profissional->id }}">{{ $profissional->pessoas->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label>Paciente</label>
                    <select class="form-control" name="paciente_id" id="paciente_id">
                        @foreach($pacientes as $paciente)
                            <option @if((int) old('id') === $paciente->id) selected
                                    @endif value="{{ $paciente->id }}">{{ $paciente->pessoas->nome}}</option>
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

        <input hidden value="E" name="status_agendamento">

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Salvar Agendamento</button>
        </div>
    </form>

    {{-- 'Token:' . session('token') --}}


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Agendamentos dos profissionais</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right"
                                   placeholder="Procurar">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
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
                            <tbody>
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
            $('#profissional_id, #paciente_id').select2();

            var tokenAPI = {!! json_encode(session('token')) !!};

            $('#profissional_id').change(function () {
                var dataAgendamento = new Date($("#data_agendamento").val())
                var diaDaSemana = dataAgendamento.getDay()
                var idProfissional = $(this).val()


                $("#horario").empty();
                $.ajax({
                        url: '/api/horario/' + idProfissional,
                        method: "POST",
                        data: {
                            'dia_semana': diaDaSemana
                        },
                        headers: {"Authorization": "Bearer " + tokenAPI},
                        success: (data) => {
                            // console.log(data)
                            $.each(data, function (i, item) {
                                //var newDateObj = moment(data.horario_inicio).add(30, 'm').toDate();
                             //   console.log(newDateObj)
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
