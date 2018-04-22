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