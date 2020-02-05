@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Operation</div>
                <div class="card-body">
                    <a href="#" data-toggle="modal" data-target="#createModal"  class="btn btn-success btn-sm"
                        title="Ajouter Operation">
                        <i class="fa fa-plus" aria-hidden="true"></i> Ajouter
                    </a>

                    <form method="GET" action="{{ url('/admin/operation') }}" accept-charset="UTF-8"
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
                                    <th>Reference</th>
                                    <th>Date</th>
                                    <th>Membre</th>
                                    <th>Responsable</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($operation as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->membre }} {{ $item->membre_prenom }}</td>
                                    <td>{{ $item->responsable }} {{ $item->responsable_prenom }}</td>
                                    <td style="color: {{ $item->end === 'yes' ? 'green' : 'blue' }}">{{ $item->end === 'yes' ? 'Terminé' : 'En cours' }}</td>
                                    
                                    <td>
                                        <a href="{{ url('/admin/operation/' . $item->id) }}"
                                            title="Voir Operation"><button class="btn btn-info btn-sm"><i
                                                    class="fa fa-eye" aria-hidden="true"></i> Gérer</button></a>
                                        <a href="{{ url('/admin/operation/' . $item->id . '/edit') }}"
                                            title="Modifier Operation"><button class="btn btn-primary btn-sm"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Modifier</button></a>

                                        <form method="POST" action="{{ url('/admin/operation' . '/' . $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Operation"
                                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $operation->appends(['search' =>
                            Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1"> Ajout Opération </h4>
            </div>
            <div class="modal-body">
                @include ('admin.operation.create')
            </div>
        </div>
    </div>
</div>
@endsection