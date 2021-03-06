@extends('adminlte::page')

@section('title', 'Adicionar uma especialidade a uma profissão')

@section('content_header')
    <h1>Adicionar uma especialidade a uma profissão</h1>
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
                    <label>Profissão</label>
                    <select class="form-control" name="profissao_id" id="profissao_id">
                        @foreach($profissoes as $profissao)
                            <option @if((int) old('id') === $profissao->id) selected
                                    @endif value="{{ $profissao->id }}">{{ $profissao->descricao }}</option>
                        @endforeach
                    </select>
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

                <div class="col-sm-3">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        @foreach( $status as $chave => $valor )
                            <option value="{{$chave}}">{{$valor}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Adicionar</button>
        </div>
    </form>


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Profissões e suas respectivas especialidades</h3>

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

                    @if($especialidades_profissoes)
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Código Profissão</th>
                                <th>Profissão</th>
                                <th>Código Especialidade</th>
                                <th>Especialidade</th>
                                <th>Status</th>
                                <th>Ações</th>
                            <tr>
                            </thead>
                            <tbody>
                            @foreach($especialidades_profissoes as $profissao)
                                @foreach($profissao->especialidades as $especialidade)
                                    <tr>
                                        <td>{{ $profissao->id }}</td>
                                        <td>{{ $profissao->descricao }}</td>
                                        <td>{{ $especialidade->id }}</td>
                                        <td>{{ $especialidade->nome }}</td>
                                        <td>{{ $especialidade->pivot->status }}</td>
                                        <td style="display: inline-flex;">
                                            <form action="{{ route('especialidade-profissao.destroy', $profissao->id ) }}"
                                                  method="POST">
                                                {{ method_field('DELETE') }}{{csrf_field()}}
                                                <input hidden name="profissao_id" value="{{  $profissao->id  }}">
                                                <input hidden name="especialidade_id"
                                                       value="{{  $especialidade->id  }}">
                                                <a onclick="return confirm('Deseja realmente deletar a profissão {{  $profissao->descricao  }} e a especialidade {{  $especialidade->nome  }}?')? this.parentNode.submit() : void(0);"
                                                   class="btn btn-info">Apagar
                                                </a>
                                            </form>
                                        </td>
                                    <tr>
                                @endforeach
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



    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#especialidade_id, #profissao_id').select2();
            });
        </script>
    @endpush
@stop