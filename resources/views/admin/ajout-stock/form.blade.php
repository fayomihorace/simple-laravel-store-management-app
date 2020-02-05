<div class="form-group">
    <label for="type" class="control-label">{{ 'Produit' }}</label>
    <select name="produit" class="form-control" id="produit">
        @foreach ($produits as $produit)
        <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
        @endforeach
    </select>
    {!! $errors->first('produit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('quantite') ? 'has-error' : ''}}">
    <label for="quantite" class="control-label">{{ 'Quantite' }}</label>
    <input class="form-control" name="quantite" type="number" id="quantite" value="{{ isset($ajoutstock->quantite) ? $ajoutstock->quantite : ''}}" >
    {!! $errors->first('quantite', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('prix') ? 'has-error' : ''}}">
    <label for="prix" class="control-label">{{ 'Prix' }}</label>
    <input class="form-control" name="prix" type="number" id="prix" value="{{ isset($ajoutstock->prix) ? $ajoutstock->prix : ''}}" >
    {!! $errors->first('prix', '<p class="help-block">:message</p>') !!}
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
<div class="form-group">
    <label for="type" class="control-label">{{ 'Fournisseur' }}</label>
    <select name="fournisseur" class="form-control" id="fournisseur">
        @foreach ($fournisseurs as $fournisseur)
        <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}  {{ $fournisseur->prenom }}</option>
        @endforeach
    </select>
    {!! $errors->first('fournisseur', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Créer' }}">
</div>
