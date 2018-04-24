@extends('adminlte::page')

@section('title', 'Vincular um paciente/profissional a um usuário')

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
                    <label for="usuario">Usuário</label>
                    <input type="text" value="" name="usuario" class="form-control" maxlength="50" required>
                </div>

                <div class="col-sm-3">
                    <label for="password">Senha</label>
                    <input type="password" value="" name="password" class="form-control" maxlength="20" required>
                </div>

                <div class="col-sm-2">
                    <label>Nível de acesso</label>
                    <select class="form-control" name="nivel_id" id="nivel_id">
                        <option value="{}" selected>Selecione um nível</option>
                        @foreach($niveis as $nivel)
                            <option @if((int) old('id') === $nivel->id) selected
                                    @endif value="{{ json_encode($nivel) }}">{{ $nivel->descricao}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4">
                    <label>Pessoa</label>
                    <select class="form-control" name="pessoa_id" id="pessoa_id"></select>
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
                    <h3 class="box-title">Lista de Usuários</h3>
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
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuário</th>
                            <th>Nome</th>
                            <th>Nível</th>
                        <tr>
                        </thead>
                        <tbody>
                        @forelse($list_users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->usuario }}</td>
                                <td>{{ $user->pessoa->nome }}</td>
                                <td><span class="label label-success"> {{ $user->nivel_acesso->descricao }}</td>
                            {{-- <td style="display: inline-flex;">
                                 <a class="btn btn-primary" href="{{ route('profissao.edit', $user->id) }}">Editar</a>
                                 <form action="{{ route('profissao.destroy', $user->id) }}" method="POST">
                                     {{ method_field('DELETE') }}{{csrf_field()}}
                                     <a onclick="return confirm('Deseja realmente deletar a profissão {{  $profissao->descricao  }}?')? this.parentNode.submit() : void(0);"
                                        class="btn btn-info">Apagar
                                     </a>
                                 </form>
                             </td> --}}
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
        <script>
            $(document).ready(function () {
                var tokenAPI = {!! json_encode(session('token')) !!};
                // console.log( tokenAPI )

                $('#pessoa_id').select2()

                $('#nivel_id').change(function () {
                    var objNivel = JSON.parse($(this).val())
                    // console.log( $(this).val() )
                    $("#pessoa_id").empty();
                    $.ajax({
                        url: objNivel.api,
                        headers: {"Authorization": "Bearer " + tokenAPI},
                        success: (data) => {
                        $.each(data, function (i, item) {
                        $('#pessoa_id').append($('<option>', {
                            value: item.pessoas.id,
                            text: item.pessoas.nome
                        }));
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
