@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Classes</h4>
                    <a href="#Cadastrar" data-toggle="modal" style="font-size: 20pt"><i class="fa fa-plus-circle"></i></a>
                </div>
            </div>
            @if(session('Error'))
                    <div class="alert alert-danger">
                        <p>{{session('Error')}}</p>
                    </div>
                @endif
                @if(session('Sucesso'))
                    <div class="alert alert-success">
                        <p>{{session('Sucesso')}}</p>
                    </div>
                @endif
            <div class="card-body">
                <div class="row">
                    @foreach ($classe as $lista)
                        <div class="col-md-2 col-12 col-lg-2">
                            <div class="agenda">
                                <div class="agenda-title">
                                    <h4>{{$lista->nome_classe}}</h4>
                                    <h4>{{$lista->funcionario->nome}}</h4>
                                </div>
                                <div class="agenda-body">
                                    <a href="#Agenda" data-toggle="modal" onclick="classe_show({{$lista}})" class="text-warning mr-2"><i class="fa fa-eye"></i> </a>
                                    <a href="#Cadastrar" data-toggle="modal" onclick="classe_editor({{$lista}})" class="text-primary mr-2"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('classe.apagar',$lista->id)}}" class="text-danger "><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Cadastrar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Cadastrar Classe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('classe.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nome_classe">Nome da Classe</label>
                            <div class="form-input">
                                <input type="text" class="form-control" name="nome_classe" id="nome_classe">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    function classe_editor(valor) {
        document.getElementById('id').value = valor.id;
        document.getElementById('nome_classe').value = valor.nome_classe;
    }
    function classe_show(valor) {
        document.getElementById('nome_classe').innerText = valor.nome_classe;
    }
    function limpar() {
        document.getElementById('id').value = "";
        document.getElementById('nome_classe').value = "";
    }

</script>

 <div class="modal fade" id="Agenda" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">
                            Evento -  <span id="titulo"></span>
                        </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="horario">
                        Local: <span id="lugar"></span> - <span id="quando"></span> <br>
                        <span id="inicio"></span> - <span id="fim"></span> <br>
                        Participante: <span id="partic"></span>
                    </div>
                    <hr>
                    <div>
                        <p id="descri"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>

 <script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM

    });
 </script>
@endsection
