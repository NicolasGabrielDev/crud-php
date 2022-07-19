<div class="form">
    <div class="form-group">
        <label for="descricao">Descrição: </label>
        <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao') }}">
    </div>

    <div class="form-group">
        <label for="unidade">UN: </label>
        <select class="form-control" id="unidade" name="unidade">
            @foreach($unidades as $unidade)
                <option value="{{ $unidade }}">{{ $unidade }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="valor">Valor: </label>
        <input type="number" class="form-control" id="valor" name="valor" onmousewheel="return false;" step="0.01">
    </div>

    <div class="form-group">
        <label for="estoque">É estocável?</label>
        <select class="form-control" id="estoque" name="estoque">
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </div>
</div>