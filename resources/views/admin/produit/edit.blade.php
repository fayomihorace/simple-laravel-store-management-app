@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-lg-6 offset-lg-3 col-sm-12">
            <div class="card">
                <div class="card-header">Edit Produit #{{ $produit->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/produit') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <form method="POST" action="{{ url('/admin/produit/' . $produit->id) }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        @include ('admin.produit.form', ['formMode' => 'edit', 'categories'=>$categories])

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
