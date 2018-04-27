@extends('adminlte::page')

@section('title', 'Cadastro de Profissão - Clínica Software')

@section('content_header')
    <h1>Cadastro de profissões</h1>
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
                    <label for="descricao">Nome</label>
                    <input type="text" value="{{  old('descricao') }}" name="descricao" class="form-control"
                           maxlength="50" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Salvar Profissão</button>
        </div>
    </form>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de profissões</h3>

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
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        <tr>
                        </thead>
                        <tbody>
                        @forelse($profissoes as $profissao)
                            <tr>
                                <td>{{ $profissao->id }}</td>
                                <td>{{ $profissao->descricao }}</td>
                                <td style="display: inline-flex;">
                                    <a class="btn btn-primary" href="{{ route('profissao.edit', $profissao->id) }}">Editar</a>
                                    <form action="{{ route('profissao.destroy', $profissao->id) }}" method="POST">
                                        {{ method_field('DELETE') }}{{csrf_field()}}
                                        <a onclick="return confirm('Deseja realmente deletar a profissão {{  $profissao->descricao  }}?')? this.parentNode.submit() : void(0);"
                                           class="btn btn-info">Apagar
                                        </a>
                                    </form>
                                </td>
                            <tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>


    @push('scripts')

    @endpush
@stop