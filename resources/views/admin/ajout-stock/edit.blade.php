@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-lg-6 offset-lg-3 col-sm-12">
                <div class="card">
                    <div class="card-header">Edit AjoutStock #{{ $ajoutstock->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/ajout-stock') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/ajout-stock/' . $ajoutstock->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.ajout-stock.form', ['formMode' => 'edit', 'magazins'=>$magazins, 'fournisseurs'=>$fournisseurs, 'produits'=>$produits])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
