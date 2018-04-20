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

    <form action="{{ url('profissional', [$profissional->id])}}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-4">
                    <label for="nome">Nome</label>
                    <input type="text" value="{{  $profissional->pessoas->nome }}" name="nome" class="form-control" maxlength="50" required>
                </div>
                <div class="col-sm-4">
                    <label>Status</label>
                    <select class="form-control" name="sexo">
                        @foreach( $sexos as $chave => $valor )
                            <option @if((string) $profissional->pessoas->sexo == $chave) selected
                                    @endif value="{{ $chave }}">{{ $valor }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="nome">Data de Nascimento</label>
                    <input type="date" value = "{{ Carbon\Carbon::parse($profissional->pessoas->data_nascimento)->format('Y-m-d') }}" name="data_nascimento" class="form-control"
                           required>
                </div>

            </div>


            <div class=" row">
                <div class="col-sm-3">
                    <label for="telefone">Telefone</label>
                    <input type="text" value="{{  $profissional->pessoas->telefone }}" id="telefone" name="telefone"
                               class="form-control" minlength="15" required>
                </div>

                <div class="col-sm-3">
                    <label for="cpf">CPF</label>
                    <input type="text" value="{{  $profissional->pessoas->cpf }}" id="cpf" name="cpf"
                           class="form-control" minlength="14"  required>
                </div>

                <div class="col-sm-3">
                    <label for="cpf">Cód. Conselho</label>
                    <input type="text" value="{{  $profissional->cod_conselho }}" name="cod_conselho"
                           class="form-control" maxlength="5" required>
                </div>

                <div class="col-sm-3">
                    <label>Especialidade</label>
                    <select class="form-control" name="especialidade_id">
                        @foreach($especialidades as $especialidade)
                            <option @if((int) $profissional->especialidade_id === $especialidade->id) selected
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

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('#telefone').mask('(99) 99999-9999');
                $('#cpf').mask('999.999.999-99');
            });
        </script>
    @endpush
@stop