@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Categorie {{ $categorie->id }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/categorie') }}" title="Retour"><button class="btn btn-warning btn-sm"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a>
                    <a href="{{ url('/admin/categorie/' . $categorie->id . '/edit') }}" title="Modifier Categorie"><button
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Modifier</button></a>

                    <form method="POST" action="{{ url('admin/categorie' . '/' . $categorie->id) }}"
                        accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Categorie"
                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                aria-hidden="true"></i> Supprimer</button>
                    </form>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Nom </th>
                                    <td> {{ $categorie->nom }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {{ $categorie->description }} </td>
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