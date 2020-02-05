
<div class="form-group">
    <label for="type" class="control-label">{{ 'Membre' }}</label>
    <select name="membre" class="form-control" id="membre">
        @foreach ($membres as $membre)
        <option value="{{ $membre->id }}">{{ $membre->nom }}  {{ $membre->prenom }}</option>
        @endforeach
    </select>
    {!! $errors->first('membre', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="type" class="control-label">{{ 'Responsable' }}</label>
    <select name="responsable" class="form-control" id="responsable">
        @foreach ($responsables as $responsable)
        <option value="{{ $responsable->id }}">{{ $responsable->nom }}  {{ $responsable->prenom }}</option>
        @endforeach
    </select>
    {!! $errors->first('responsable', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Valider' }}">
</div>
