<div class="form-group {{ $errors->has('produit') ? 'has-error' : ''}}">
    <label for="produit" class="control-label">{{ 'Produit' }}</label>
    <input class="form-control" name="produit" type="number" id="produit" value="{{ isset($produitmagazin->produit) ? $produitmagazin->produit : ''}}" >
    {!! $errors->first('produit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('magazin') ? 'has-error' : ''}}">
    <label for="magazin" class="control-label">{{ 'Magazin' }}</label>
    <input class="form-control" name="magazin" type="number" id="magazin" value="{{ isset($produitmagazin->magazin) ? $produitmagazin->magazin : ''}}" >
    {!! $errors->first('magazin', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('stock') ? 'has-error' : ''}}">
    <label for="stock" class="control-label">{{ 'Stock' }}</label>
    <input class="form-control" name="stock" type="number" id="stock" value="{{ isset($produitmagazin->stock) ? $produitmagazin->stock : ''}}" >
    {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Valider' }}">
</div>
