@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Operation {{ $operation->id }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/operation') }}" title="Retour"><button class="btn btn-warning btn-sm"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a>
                    
                    @if($operation->end== 'no')
                    <a href="{{ url('/admin/operation/' . $operation->id . '/edit') }}" title="Modifier Operation"><button
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Modifier</button></a>
                            
                    <form method="POST" action="{{ url('admin/operation' . '/' . $operation->id) }}"
                        accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Operation"
                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                aria-hidden="true"></i> Supprimer</button>
                    </form>
                    <a href="#" data-toggle="modal" data-target="#endOperation" class="btn btn-success btn-sm"
                        title="Ajouter un  Mouvement">
                        <i class="fa fa-send" aria-hidden="true"></i> Terminer
                    </a>
                    @else
                    <a href="#" data-toggle="modal" data-target="#recuOperation" class="btn btn-primary btn-sm">
                        <i class="fa fa-file" aria-hidden="true"></i> Générer la facture
                    </a>
                    @endif
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Reference </th>
                                    <td> {{ $operation->id }} </td>
                                </tr>
                                <tr>
                                    <th> Membre </th>
                                    <td> {{ $operation->membre }} <{{ $operation->membre_prenom }} /td>
                                </tr>
                                <tr>
                                    <th> Responsable </th>
                                    <td> {{ $operation->responsable }}  {{ $operation->responsable_prenom }} </td>
                                </tr>
                                <tr>
                                    <th> Date </th>
                                    <td> {{ $operation->created_at }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @include ('admin.mouvement.index', ['mouvement' => $mouvements,
            'operation'=>$operation->id,'produits'=>$produits, 'magazins'=>$magazins, 'types'=>$types])
        </div>
    </div>
</div>
<div class="modal fade" id="endOperation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1"> Terminer l'opération </h4>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel1"> 
                Cliquez sur le bouton valider pour terminer l'enregistrement de cette opération.
                    Vous ne pourrez plus la supprimer ou la modifier.
                    Vous serez en mesure de générer la facture correspondante. 
                </h5>
                <hr>
                <a href="{{ url('/admin/operation/end') }}/{{ $operation->id }}" class="btn btn-primary ">
                        <i class="fa fa-send" aria-hidden="true"></i> Valider
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="recuOperation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1"> Facture de l'opération </h4>
            </div>
            <div class="modal-body">
            <hr>
                <a href="#"  onclick="printJS('invoice_download', 'html')" class="btn btn-primary">
                        <i class="fa fa-download text-center" aria-hidden="true"></i> Télécharger
                </a>
                <div   id="invoice_download" >
                    <h4 class="modal-title" id="exampleModalLabel1"> Facture de l'opération </h4>
                    Cliquez sur le bouton valider pour terminer l'enregistrement de cette opération.
                    Vous ne pourrez plus la supprimer ou la modifier.
                    Vous serez en mesure de générer la facture correspondante. 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
