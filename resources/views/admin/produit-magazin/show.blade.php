@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">ProduitMagazin {{ $produitmagazin->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/produit-magazin') }}" title="Retour"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a>
                        <a href="{{ url('/admin/produit-magazin/' . $produitmagazin->id . '/edit') }}" title="Modifier ProduitMagazin"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</button></a>

                        <form method="POST" action="{{ url('admin/produitmagazin' . '/' . $produitmagazin->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer ProduitMagazin" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $produitmagazin->id }}</td>
                                    </tr>
                                    <tr><th> Produit </th><td> {{ $produitmagazin->produit }} </td></tr><tr><th> Magazin </th><td> {{ $produitmagazin->magazin }} </td></tr><tr><th> Stock </th><td> {{ $produitmagazin->stock }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
