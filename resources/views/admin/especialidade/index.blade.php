@extends('adminlte::page')

@section('title', 'Cadastro de Especialidade - Clínica Software')

@section('content_header')
    <h1>Cadastro de Especialidades</h1>
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




    <form action="" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-3">
                    <label for="name">Nome</label>
                    <input type="text" value="{{  old('nome') }}" name="nome" class="form-control" maxlength="50"
                           required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label for="name">Descrição</label>
                    <textarea class="form-control" name="descricao" rows="3" maxlength="255"
                              required>{{ old('descricao') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Salvar Especialidade</button>
        </div>
    </form>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1 class="box-title">Lista de Especialidades</h1>

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
                    @if($especialidades)
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            <tr>
                            </thead>
                            <tbody>
                            @forelse($especialidades as $especialidade)
                                <tr>
                                    <td>{{ $especialidade->id }}</td>
                                    <td>{{ $especialidade->nome }}</td>
                                    <td>{{ $especialidade->descricao }}</td>
                                    <td style="display: inline-flex;">
                                        <a class="btn btn-primary"
                                           href="{{ route('especialidade.edit', $especialidade->id) }}">Editar</a>
                                        <form action="{{ route('especialidade.destroy', $especialidade->id) }}"
                                              method="POST">
                                            {{ method_field('DELETE') }}{{csrf_field()}}
                                            <a onclick="return confirm('Deseja realmente deletar a especialidade {{  $especialidade->nome  }}?')? this.parentNode.submit() : void(0);"
                                               class="btn btn-info">Apagar
                                            </a>
                                        </form>
                                    </td>
                                <tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Não há especialidades cadastradas</p>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop