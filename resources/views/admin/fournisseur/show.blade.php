@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Fournisseur {{ $fournisseur->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/fournisseur') }}" title="Retour"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a>
                        <a href="{{ url('/admin/fournisseur/' . $fournisseur->id . '/edit') }}" title="Modifier Fournisseur"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</button></a>

                        <form method="POST" action="{{ url('admin/fournisseur' . '/' . $fournisseur->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Fournisseur" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $fournisseur->id }}</td>
                                    </tr>
                                    <tr><th> Nom </th><td> {{ $fournisseur->nom }} </td></tr><tr><th> Adresse </th><td> {{ $fournisseur->adresse }} </td></tr><tr><th> Email </th><td> {{ $fournisseur->email }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
