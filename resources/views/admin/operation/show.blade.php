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
                    <a href="{{ url('/admin/operation/' . $operation->id . '/edit') }}"
                        title="Modifier Operation"><button class="btn btn-primary btn-sm"><i
                                class="fa fa-pencil-square-o" aria-hidden="true"></i>
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
                    <a href="{{ url('/admin/operation/continue') }}/{{ $operation->id }}" class="btn btn-sm btn-info ">
                        <i class="fa fa-send" aria-hidden="true"></i> Continuer l'opération
                    </a>
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
                                    <th> {{ $operation->membre }} {{ $operation->membre_prenom }} </td> </tr> <tr>
                                    <th> Responsable </th>
                                    <td> {{ $operation->responsable }} {{ $operation->responsable_prenom }} </td>
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

<div class="modal fade bd-example-modal-lg" id="recuOperation" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1"> Facture de l'opération </h4>
                
            </div>
            <div class="modal-body">
                <hr>
                <a href="#" onclick="printJS('invoice_download', 'html')" class="btn btn-primary">
                    <i class="fa fa-download text-center" aria-hidden="true"></i> Télécharger
                </a>
                <div id="invoice_download">
                    <div  style="border: 1px solid #a4adb5; padding: 2%; margin:1% ; border-radius: 4px">
                    <table style=" width: 100%; ">
                            <tbody>
                                <tr>
                                    <td style="text-align: left"><h5 class="modal-title" id="exampleModalLabel1"> Facture GestStock | LSC  </h5></td>
                                    <td style="text-align: right"><img src="https://iitech-benin.net/images/log.png" alt="iitech logo" style="height: 30px; text-align: right"></td>
                                </tr>
                            </tbody>
                    </table>
                    
                        <table style="width: 100%; background:#f0f3f4; margin-top: 10px; border: 2px solid #2d353c">
                            <tr style="width: 100%; background:#f0f3f4;">
                                <td style="background:#f0f3f4; width: 100%; padding: 1%" colspan=3>
                                    <table style="width: 100%; vertical-align: top">
                                        <tr style="width: 100%; background:#f0f3f4; color: #515050 ">
                                            <td style="background:#f0f3f4;width: 30%">Membre: <br> <strong>  {{ $operation->membre }} {{ $operation->membre_prenom }}</strong>
                                            </td>
                                            <td style="background:#f0f3f4;width: 30%">Responsable: <br> <strong>{{ $operation->responsable }} {{ $operation->responsable_prenom }}</strong>
                                            </td>
                                            <td  valign="top" style="background:#f0f3f4;width: 30%; text-align: right">
                                                # N° {{ $operation->id }} <br> <?php $date=$operation->created_at; echo date_format($date, "d/m/Y H:i:s"); ?>  <br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table style="margin-top: 20px; width: 100%; border-bottom: 2px solid #dee2e6; border-top: 1px solid #dee2e6;">
                            <thead>
                                <tr style="text-align: left">
                                    <th>#</th>
                                    <th>Mouvement </th>
                                    <th>Produit</th>
                                    <th>Quantite</th>
                                    <th>Magazin</th>
                                    @if(session('operation_is_end')== 'no')
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                        </table>
                        @foreach($mouvements as $item)
                        <table style="margin-bottom: 20px; width: 100%; border-top: 1px solid #dee2e6">
                            <tbody>
                                <tr  style="text-align: left">
                                    <td  style="text-align: left">
                                        <table style="margin-top: 20px; width: 100%">
                                            <tbody>
                                                <tr  style="text-align: left; ">
                                                    <td  style="text-align: left; width: 4%">{{ $loop->iteration }}</td>
                                                    <td  style="text-align: left; width: 31%">{{ $item->type }}</td>
                                                    <td style="text-align: left; width: 20%">{{ $item->produit }}</td>
                                                    <td style="text-align: left; width: 23%">{{ $item->quantite }}</td>
                                                    <td style="text-align: left">{{ $item->magazin }}</td>
                                                    <td style="text-align: left">
                                                        @if(session('operation_is_end')== 'no')
                                                        <form method="POST" action="{{ url('/admin/mouvement' . '/delete/' . $item->id) }}"
                                                            accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" action="POST" operation="{{$operation}}"
                                                                class="btn btn-danger btn-sm" title="Supprimer Mouvement"
                                                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                                    class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach
                        <hr>
                        <h6 style="text-align: center; color: #6c757d; font-size:0.8em; font-weight: bold">GestStock | IITECH-BENIN</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
