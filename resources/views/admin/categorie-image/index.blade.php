<div class="card">
    <div class="card-header">categorie-images</div>
    <div class="card-body">
    <a href="#" data-toggle="modal" data-target="#addcategorie-image" class="btn btn-success btn-sm"
            title="Ajouter une  categorie-image">
            <i class="fa fa-plus" aria-hidden="true"></i> Ajouter une image
        </a>

        <form method="GET" action="{{ url('/admin/categorie-image') }}" accept-charset="UTF-8"
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
                        <th>categorie-image</th>
                        <th>categorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($image as $item)
                    <tr style="border-bottom:1px solid rgba(0,0,0,.125);">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div>
                                <img  style="max-width:200px ; max-height:200px; border:1px solid rgba(0,0,0,.125); border-radius: 5px" class="text-center" src="{{ url($item->lien) }}" alt="Votre categorie-image" />
                            </div>
                        </td>
                        <td>{{ $item->categorie }}</td>
                        <td>
                            <a  data-toggle="modal" data-target="#seecategorie-image_{{$item->id}}" class="btn-sm"
                                 href="#" title="View categorie-image"><button
                                    class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                                    Agrandir</button>
                            </a>
                            <div class="modal fade" id="seecategorie-image_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel1"> categorie-image </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <img  style="width:100%; height:100%" class="text-center" src="{{ url($item->lien) }}" alt="Votre categorie-image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ url('/admin/categorie-image/'.$item->id) }}"
                                accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer categorie-image"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i> Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addcategorie-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1"> Ajouter une image </h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/admin/categorie-image') }}" accept-charset="UTF-8" class="form-horizontal"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include ('admin.categorie-image.form', ['formMode' => 'create', 'categorie'=>$categorie])
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result).css('display', 'block')
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>