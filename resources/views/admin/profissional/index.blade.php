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

    @include('admin.profissional.form-create')


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Profissionais</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
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
                                        <form action="{{ route('profissional.destroy', $profissional->id) }}"
                                              method="POST">
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
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#telefone').mask('(99) 99999-9999');
                $('#cpf').mask('999.999.999-99');
                $('#especialidade_id').select2();
            });
        </script>
    @endpush
@stop
