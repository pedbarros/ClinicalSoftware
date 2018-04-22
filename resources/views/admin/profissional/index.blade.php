@extends('adminlte::page')

@section('title', 'Cadastro de Profissional')

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
                    <label for="nome">Nome</label>
                    <input type="text" value="" name="nome" class="form-control" maxlength="50" required>
                </div>
                <div class="col-sm-4">
                    <label>Status</label>
                    <select class="form-control" name="sexo">
                        @foreach( $sexos as $chave => $valor )
                            <option value="{{$chave}}">{{$valor}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="nome">Data de Nascimento</label>
                    <input type="date" value="" name="data_nascimento" class="form-control"
                           required>
                </div>

            </div>


            <div class=" row">
                <div class="col-sm-3">
                    <label for="telefone">Telefone</label>
                    <input type="text" value="" id="telefone" name="telefone" class="form-control" minlength="15"
                           required>
                </div>

                <div class="col-sm-3">
                    <label for="cpf">CPF</label>
                    <input type="text" value="" id="cpf" name="cpf" class="form-control" minlength="14"
                           required>
                </div>

                <div class="col-sm-3">
                    <label for="cpf">Cód. Conselho</label>
                    <input type="text" value="" name="cod_conselho" class="form-control" maxlength="5"
                           required>
                </div>

                <div class="col-sm-3">
                    <label>Especialidade</label>
                    <select class="form-control" name="especialidade_id" id="especialidade_id">
                        @foreach($especialidades as $especialidade)
                            <option @if((int) old('id') === $especialidade->id) selected
                                    @endif value="{{ $especialidade->id }}">{{ $especialidade->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="hidden" name="data_entrada" value="{{ date('Y-m-d h:i:s') }}">

            <div class="form-group" style="margin-top: 5px;">
                <button type="submit" class="btn btn-danger">Salvar Profissional</button>
            </div>
        </div>
    </form>

    <h2>Lista de Profissionais</h2>
    <div class="box-body">
        @if($profissionais)
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cód. Conselho</th>
                    <th>Nome</th>
                    <th>Data de Entrada</th>
                    <th>Especialidade</th>
                    <th>Ações</th>
                <tr>
                </thead>
                <tbody>
                @foreach($profissionais as $profissional)
                    <tr>
                        <td>{{ $profissional->id }}</td>
                        <td>{{ $profissional->cod_conselho }}</td>
                        <td>{{ $profissional->pessoas->nome }}</td>
                        <td>{{ Carbon\Carbon::parse($profissional->data_entrada)->format('d/m/Y h:i:s' ) }}</td>
                        <td>{{ $profissional->especialidades->nome }}</td>
                        <td style="display: inline-flex;">
                            <a class="btn btn-primary"
                               href="{{ route('profissional.edit', $profissional->id) }}">Editar</a>
                            <form action="{{ route('profissional.destroy', $profissional->id) }}" method="POST">
                                @csrf {{ method_field('DELETE') }}
                                <a onclick="return confirm('Deseja realmente deletar o profissional {{  $profissional->pessoas->nome  }}?')? this.parentNode.submit() : void(0);"
                                   class="btn btn-info">Apagar
                                </a>
                            </form>
                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Não há profissionais cadastrados</p>
        @endif
    </div>
    @push('scripts')
        <script>
            $(document).ready(function(){
                $('#telefone').mask('(99) 99999-9999');
                $('#cpf').mask('999.999.999-99');
                $('#especialidade_id').select2();
            });
        </script>
    @endpush
@stop
