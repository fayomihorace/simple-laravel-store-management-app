<div class="card">
    <div class="card-header">Mouvements</div>
    <div class="card-body">
        @if(session('operation_is_end')== 'no')
        <a href="#" data-toggle="modal" data-target="#addMouvement" class="btn btn-success btn-sm"
            title="Ajouter un  Mouvement">
            <i class="fa fa-plus" aria-hidden="true"></i> Ajouter un Mouvement
        </a>
        @endif
        <form method="GET" action="{{ url('/admin/mouvement') }}" accept-charset="UTF-8"
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

        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type </th>
                        <th>Produit</th>
                        <th>Quantite</th>
                        <th>Magazin</th>
                        @if(session('operation_is_end')== 'no')
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($mouvement as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->produit }}</td>
                        <td>{{ $item->quantite }}</td>
                        <td>{{ $item->magazin }}</td>
                        <td>
                        @if(session('operation_is_end')== 'no')
                            <!--a href="{{ url('/admin/mouvement/' . $item->id) }}" title="Voir Mouvement"><button
                                    class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                                    Voir</button></a>
                            <a href="{{ url('/admin/mouvement/' . $item->id . '/edit' ) }}"
                                title="Edit Mouvement"><button class="btn btn-primary btn-sm"><i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    Edit</button></a-->

                            <form method="POST" action="{{ url('/admin/mouvement' . '/' . $item->id) }}"
                                accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input type="hidden" name="operation" value="{{ $operation }}">
                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Mouvement"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i> Supprimer</button>
                            </form>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addMouvement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1"> Ajouter un mouvement </h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/admin/mouvement') }}" accept-charset="UTF-8" class="form-horizontal"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include ('admin.mouvement.form', ['formMode' => 'create', 'operation'=>$operation,'produits'=>$produits, 'magazins'=>$magazins, 'types'=>$types])
                </form>
            </div>
        </div>
    </div>
</div>