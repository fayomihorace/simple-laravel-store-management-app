@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ajout stock</div>
                <div class="card-body">
                    <a href="#" data-toggle="modal" data-target="#createAddStockModal"  class="btn btn-success btn-sm"
                        title="Ajouter Operation">
                        <i class="fa fa-plus" aria-hidden="true"></i> Ajouter
                    </a>

                    <form method="GET" action="{{ url('/admin/ajout-stock') }}" accept-charset="UTF-8"
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
                                    <th>Date</th>
                                    <th>Produit</th>
                                    <th>Quantite</th>
                                    <th>Prix</th>
                                    <th>Fournisseur</th>
                                    <th>Magazin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ajoutstock as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><?php echo date_format($item->created_at, "d/m/Y H:i:s"); ?></td>
                                    <td>{{ $item->produit }}</td>
                                    <td>{{ $item->quantite }}</td>
                                    <td>{{ $item->prix }}</td>
                                    <td>{{ $item->fournisseur }}</td>
                                    <td>{{ $item->magazin }}</td>
                                    <td>
                                        <!--a href="{{ url('/admin/ajout-stock/' . $item->id) }}"
                                            title="Voir AjoutStock"><button class="btn btn-info btn-sm"><i
                                                    class="fa fa-eye" aria-hidden="true"></i> Voir</button></a>
                                        <a href="{{ url('/admin/ajout-stock/' . $item->id . '/edit') }}"
                                            title="Edit AjoutStock"><button class="btn btn-primary btn-sm"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Edit</button></a-->

                                        <form method="POST" action="{{ url('/admin/ajout-stock' . '/' . $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                title="Supprimer AjoutStock"
                                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</button>
                                        </form-->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $ajoutstock->appends(['search' =>
                            Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createAddStockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1"> Ajout Stock </h4>
            </div>
            <div class="modal-body"  action="{{ url('/admin/ajout-stock') }}" >
                
                    @include('admin.ajout-stock.create', ['magazins'=>$magazins, 'produits'=>$produits, 'fournisseurs'=>$fournisseurs])
                
            </div>
        </div>
    </div>
</div>
<script src="/jquery.min.js"></script>
<script>
    var action=$('#createAddStockModal .modal-body').attr('action')
    $('#createAddStockModal .modal-body').wrap('<form method="POST" action="'+action+'" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data"></form>')
</script>
@endsection
