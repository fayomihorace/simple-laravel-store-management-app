@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Produitmagazin</div>
                <div class="card-body">

                    <form method="GET" action="{{ url('/admin/produit-magazin') }}" accept-charset="UTF-8"
                        class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Recherchez..."
                                value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produit</th>
                                    <th>Magazin</th>
                                    <th>Stock</th>
                                    <!--th>Actions</th-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produitmagazin as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="replaceID" type="" >{{ $item->produit }}</td>
                                    <td>{{ $item->magazin }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <!--td>
                                            <a href="{{ url('/admin/produit-magazin/' . $item->id) }}" title="Voir ProduitMagazin"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Voir</button></a>
                                            <a href="{{ url('/admin/produit-magazin/' . $item->id . '/edit') }}" title="Edit ProduitMagazin"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/produit-magazin' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete ProduitMagazin" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td-->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $produitmagazin->appends(['search' =>
                            Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
