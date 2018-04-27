@extends('adminlte::page')

@section('title', 'Cadastro de Agendas dos profissionais')

@include('admin.includes.alerts')

@section('content')

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-2">
                    <label for="data_agendamento">Data de agendamento</label>
                    <input type="date" value="" name="data_agendamento" id="data_agendamento"
                           class="form-control" required>
                </div>

                <div class="col-sm-3">
                    <label>Profissional</label>
                    <select class="form-control" name="profissional_id" id="profissional_id">
                        @foreach($profissionais as $profissional)
                            <option @if((int) old('id') === $profissional->id) selected
                                    @endif value="{{ $profissional->id }}">{{ $profissional->pessoas->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="horario">Horários</label>
                    <select class="form-control" name="horario" id="horario"></select>
                </div>

                <div class="col-sm-3">
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


    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#profissional_id, #paciente_id').select2();

            var tokenAPI = {!! json_encode( session('token') ) !!};

            $('#profissional_id').change(function () {
                var dataAgendamento = new Date($("#data_agendamento").val())
                var diaDaSemana = dataAgendamento.getDay()
                var idProfissional = $(this).val()

                // console.log("diaDaSemana: " + diaDaSemana + " url: " + '/api/horario/' + idProfissional)
                $("#horario").empty();
                $.ajax({
                      url: '/api/horario/' + idProfissional,
                      method: "POST",
                      data: { 'dia_semana': diaDaSemana },
                      headers: {"Authorization": "Bearer " + tokenAPI},
                      success: (data) => {
                          // console.log(data)
                            $.each(data, function (i, item) {
                                var time = moment( item.horario_inicio, 'HH:mm' )
                                while (time.format('HH:mm') <= item.horario_final){
                                    console.log("time: " + time.format('HH:mm') + " i: " + i)
                                    time.add('30', 'minutes')
                                }
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
