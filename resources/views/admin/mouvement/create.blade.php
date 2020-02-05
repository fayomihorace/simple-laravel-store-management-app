<div class="card">
    <div class="card-header">Nouveau Mouvement</div>
    <div class="card-body">
        <a href="{{ url('/admin/mouvement') }}" title="Retour"><button class="btn btn-warning btn-sm"><i
                    class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a>
        <br />
        <br />

        @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ url('/admin/mouvement') }}" accept-charset="UTF-8" class="form-horizontal"
            enctype="multipart/form-data">
            {{ csrf_field() }}

            @include ('admin.mouvement.form', ['formMode' => 'create'])

        </form>
    </div>
</div>