
<div style="margin: 20%">


<table style="width: 100%; background:#f0f3f4;">
    <tr style="width: 100%; background:#f0f3f4;">
        <td style="background:#f0f3f4; width: 100%; padding: 1%" colspan=3>
            <table style="width: 100%">
                <tr style="width: 100%; background:#f0f3f4; ">
                    <td style="background:#f0f3f4;width: 30%">De: <br> lklklk 
                    </td>
                    <td style="background:#f0f3f4;width: 30%">A: <br> lklklk 
                    </td>
                    <td style="background:#f0f3f4;width: 30%; text-align: right"> Facture<br>Date<br> # N° </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
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
                            <form method="POST" action="{{ url('/admin/mouvement' . '/delete/' . $item->id) }}"
                                accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" action="POST" operation="{{$operation}}" class="btn btn-danger btn-sm" title="Supprimer Mouvement"
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
