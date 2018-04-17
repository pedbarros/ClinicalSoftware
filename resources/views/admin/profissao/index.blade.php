@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Cadastro de profissões</h1>
@stop

@section('content')
    <form action="" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
            <div class="form-group">
                <div class=" row">
                    <div class="col-sm-6">
                        <label for="name">Nome</label>
                        <input type="text" value="Enfermeira" name="descricao" placeholder="Descrição" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label for="name">Status</label>
                        <input type="text" value="A" name="status" placeholder="Status" class="form-control">
                    </div>
                </div>
            </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Salvar Profissão</button>
        </div>
    </form>


@stop