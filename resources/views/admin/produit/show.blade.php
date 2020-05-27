@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Produit  {{ $produit->nom }}</span> </div>
                    <div class="card-body">

                        <a href="{{ url('/admin/produit') }}" title="Retour"><button class="btn btn-warning btn-sm"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a>
                        <a href="{{ url('/admin/produit/' . $produit->id . '/edit') }}" title="Modifier Produit"><button
                                class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Modifier</button></a>

                        <form method="POST" action="{{ url('admin/produit' . '/' . $produit->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Produit"
                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                Supprimer</button>
                        </form>
                        <br />
                        <br />

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> Nom </th>
                                        <td> {{ $produit->nom }} </td>
                                    </tr>
                                    <tr>
                                        <th> Categorie </th>
                                        <td>{{ $produit->categorie }}</td>
                                    </tr>
                                    <tr>
                                        <th> Description </th>
                                        <td> {{ $produit->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> Stock </th>
                                        <td> {{ $produit->stock }} </td>
                                    </tr>
                                    <tr>
                                        <th> Stock details</th>
                                        <td> {{ $produit->stock_details }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            @include ('admin.image.index', ['image' => $images, 'produit'=>$produit->id])
        </div>
    </div>
</div>
@endsection