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
                    <select class="form-control" name="profissao_id">
                        @foreach($profissoes as $profissao)
                            <option @if((int) old('id') === $profissao->id) selected
                                    @endif value="{{ $profissao->id }}">{{ $profissao->descricao }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label>Especialidade</label>
                    <select class="form-control" name="especialidade_id">
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
            <button type="submit" class="btn btn-danger">Salvar</button>
        </div>
    </form>

    <h2>Lista de Profissões e suas respectivas especialidades</h2>
    <div class="box-body">
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
                                <a class="btn btn-primary"
                                   href="{{ route('especialidade-profissao.edit', $especialidade->id) }}">Editar</a>
                                <form action="{{ route('especialidade-profissao.destroy', $profissao->id ) }}"
                                      method="POST">
                                    {{ method_field('DELETE') }}{{csrf_field()}}
                                    <input hidden name="profissao_id" value="{{  $profissao->id  }}">
                                    <input hidden name="especialidade_id" value="{{  $especialidade->id  }}">
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
@stop