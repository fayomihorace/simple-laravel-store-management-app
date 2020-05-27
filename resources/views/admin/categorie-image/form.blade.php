<div style="display: none"  class="form-group {{ $errors->has('lien') ? 'has-error' : ''}}">
    <label for="lien" class="control-label">{{ 'Lien' }}</label>
    <input class="form-control" name="lien" type="text" id="lien" value="{{ isset($image->lien) ? $image->lien : ''}}">
    {!! $errors->first('lien', '<p class="help-block">:message</p>') !!}
</div>
<div style="display: none" class="form-group {{ $errors->has('categorie') ? 'has-error' : ''}}">
    <label for="categorie" class="control-label">{{ 'categorie' }}</label>
    <input class="form-control" name="categorie" type="number" id="categorie" value="{{  $categorie}}">
    {!! $errors->first('categorie', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="recipient-name" class="control-label">Image:</label>
    <div class="row" style="margin: 5%">
        <div class="row">
            <div>
                <img id="preview" style="width:100% ; height:100%; display: none" class="text-center" src="" alt="Votre image" />
            </div>
            <input type="file" accept="image/x-png,image/gif,image/jpeg"  style="width:100% ;"  name="image" id="image"
                onchange="readURL(this);" required="" class="form-control">
        </div>
    </div>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Ajouter' }}">
</div>
