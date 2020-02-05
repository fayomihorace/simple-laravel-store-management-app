<div class="form-group {{ $errors->has('nom') ? 'has-error' : ''}}">
    <label for="nom" class="control-label">{{ 'Nom' }}</label>
    <input class="form-control" name="nom" type="text" id="nom" value="{{ isset($produit->nom) ? $produit->nom : ''}}" >
    {!! $errors->first('nom', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="type" class="control-label">{{ 'Categorie' }}</label>
    <select name="categorie" class="form-control" id="categorie">
        @foreach ($categories as $categorie)
        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
        @endforeach
    </select>
    {!! $errors->first('categorie', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($produit->description) ? $produit->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('stock') ? 'has-error' : ''}}">
    <label for="stock" class="control-label">{{ 'Stock' }}</label>
    <input disabled class="form-control" name="stock" type="number" id="stock" value="{{ isset($produit->stock) ? $produit->stock : ''}}" >
    {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('stock_details') ? 'has-error' : ''}}">
    <label for="stock_details" class="control-label">{{ 'Stock Details' }}</label>
    <textarea class="form-control" rows="5" name="stock_details" type="textarea" id="stock_details" >{{ isset($produit->stock_details) ? $produit->stock_details : ''}}</textarea>
    {!! $errors->first('stock_details', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Valider' }}">
</div>
