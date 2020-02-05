@if ($errors->any())
<ul class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

<form method="POST" action="{{ url('/admin/categorie') }}" accept-charset="UTF-8" class="form-horizontal"
    enctype="multipart/form-data">
    {{ csrf_field() }}

    @include ('admin.categorie.form', ['formMode' => 'create'])

</form>
