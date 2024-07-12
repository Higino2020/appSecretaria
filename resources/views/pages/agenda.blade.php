@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Agenda de Actividades</h4>
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
                    @foreach ($agenda as $lista)
                        <div class="col-md-2 col-12 col-lg-2">
                            <div class="agenda">
                                <div class="agenda-title">
                                    <h4>{{$lista->tipo_evento}}</h4>
                                    <h5>{{$lista->data}}</h5>
                                </div>
                                <div class="agenda-body">
                                    <p><b>Local: </b>{{$lista->local}}
                                        <br>
                                        <b>Represetante: </b>{{$lista->funcionario->nome}}
                                    </p>
                                    <p></p>
                                    <a href="#Agenda" data-toggle="modal" onclick="agendaShow({{$lista}})" class="text-warning mr-2"><i class="fa fa-eye"></i> </a>
                                    <a href="#Cadastrar" data-toggle="modal" onclick="editar({{$lista}})" class="text-primary mr-2"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('agenda.apagar',$lista->id)}}" class="text-danger "><i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Cadastrar Agendas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('agenda.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="tipo_evento">Nome do Evento</label>
                            <div class="form-input">
                                <input type="text" class="form-control" name="tipo_evento" id="tipo_evento">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data">Data do Evento</label>
                            <div class="form-input">
                                <input type="date" min="{{date('Y-m-d')}}" class="form-control" name="data" id="data">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hora_inicio">Hora de Inicio do Evento</label>
                            <div class="form-input">
                                <input type="time" class="form-control" name="hora_inicio" id="hora_inicio">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hora_fim">Hora de fim do Evento</label>
                            <div class="form-input">
                                <input type="time" class="form-control" name="hora_fim" id="hora_fim">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="local"> Local do Evento</label>
                            <div class="form-input">
                                <input type="text" class="form-control" name="local" id="local">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="participante">Participante do Evento</label>
                            <div class="form-input">
                                <select class="form-control" name="participante" id="participante">
                                    @foreach (App\Models\Funcionario::orderBy('nome','ASC')->get() as $funcio)
                                        <option value="{{$funcio->id}}">{{$funcio->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao_evento">Descrição</label>
                            <div class="form-input">
                                <textarea name="descricao_evento" id="descricao_evento" style="resize: none" class="form-control" cols="30" rows="4"></textarea>
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
    function editar(valor) {
        document.getElementById('id').value = valor.id;
        document.getElementById('tipo_evento').value = valor.tipo_evento;
        document.getElementById('data').value = valor.data;
        document.getElementById('hora_inicio').value = valor.hora_inicio;
        document.getElementById('hora_fim').value = valor.hora_fim;
        document.getElementById('local').value = valor.local;
        document.getElementById('participante').value = valor.participante;
        document.getElementById('descricao_evento').value = valor.descricao_evento;
    }
    function agendaShow(valor) {
        document.getElementById('titulo').innerText = valor.tipo_evento;
        document.getElementById('quando').innerText = valor.data;
        document.getElementById('inicio').innerText = valor.hora_inicio;
        document.getElementById('fim').innerText = valor.hora_fim;
        document.getElementById('lugar').innerText = valor.local;
        document.getElementById('partic').innerText = valor.funcionario.nome;
        document.getElementById('descri').innerText = valor.descricao_evento;
    }
    function limpar() {
        document.getElementById('id').value = "";
        document.getElementById('data').value = "";
        document.getElementById('hora_inicio').value = "";
        document.getElementById('hora_fim').value = "";
        document.getElementById('local').value = "";
        document.getElementById('participante').value = "";
        document.getElementById('data_contratacao').value = "";
    }
    
</script>

 <div class="modal fade" id="Agenda" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">
                            Enveto -  <span id="titulo"></span>
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