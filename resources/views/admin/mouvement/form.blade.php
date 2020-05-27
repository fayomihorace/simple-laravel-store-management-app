<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
    <select name="type" class="form-control" id="type">
        @foreach ($types as $optionKey =>
        $optionValue)
        <option value="{{ $optionKey }}"
            {{ (isset($mouvement->type) && $mouvement->type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}
        </option>
        @endforeach
    </select>
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="type" class="control-label">{{ 'Produit' }}</label>
    <select name="produit" class="form-control" id="produit">
        @foreach ($produits as $produit)
        <option value="{{ $produit->id }}">{{ $produit->nom }} / {{ $produit->produit_stock_details}}</option>
        @endforeach
    </select>
    {!! $errors->first('produit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('quantite') ? 'has-error' : ''}}">
    <label for="quantite" class="control-label">{{ 'Quantite' }}</label>
    <input class="form-control" name="quantite" type="number" id="quantite"
        value="{{ isset($mouvement->quantite) ? $mouvement->quantite : ''}}">
    {!! $errors->first('quantite', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="type" class="control-label">{{ 'Magazin' }}</label>
    <select name="magazin" class="form-control" id="magazin">
        @foreach ($magazins as $magazin)
        <option value="{{ $magazin->id }}">{{ $magazin->nom }}</option>
        @endforeach
    </select>
    {!! $errors->first('magazin', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group" style="display: none">
    <label for="operation" class="control-label">{{ 'Operation' }}</label>
    <input class="form-control" name="operation" type="number" id="operation" value="{{ $operation }}">
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea"
        id="description">{{ isset($mouvement->description) ? $mouvement->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Valider' }}">
</div>
