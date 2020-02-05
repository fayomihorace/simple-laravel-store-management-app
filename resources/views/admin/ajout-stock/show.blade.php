@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">AjoutStock {{ $ajoutstock->id }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/ajout-stock') }}" title="Retour"><button class="btn btn-warning btn-sm"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a>
                    <!--a href="{{ url('/admin/ajout-stock/' . $ajoutstock->id . '/edit') }}" title="Edit AjoutStock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/ajoutstock' . '/' . $ajoutstock->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete AjoutStock" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form-->
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Produit </th>
                                    <td> {{ $ajoutstock->produit }} </td>
                                </tr>
                                <tr>
                                    <th> Quantite </th>
                                    <td> {{ $ajoutstock->quantite }} </td>
                                </tr>
                                <tr>
                                    <th> Prix </th>
                                    <td> {{ $ajoutstock->prix }} </td>
                                </tr>
                                <tr>
                                    <th> Fournisseur </th>
                                    <td> {{ $ajoutstock->fournisseur }} </td>
                                </tr>
                                <tr>
                                    <th> Magazin </th>
                                    <td> {{ $ajoutstock->magazin }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
