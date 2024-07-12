@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Correspondênçia do Sistema</h4>
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
                <div class="table-responsive">
                    <table id="datatable" class="table data-tables table-striped">
                    <thead>
                        <tr class="ligth">
                            <th>Nome</th>
                            <th>Nome da Empresa</th>
                            <th>Data</th>
                            <th>Hora de Entrada</th>
                            <th>Hora de Saída</th>
                            <th>Objectivo da Visita</th>
                            <th>Responsavel</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valor as $func)
                            <tr>
                                <td>{{$func->nome}}</td>
                                <td>{{$func->empresa_organizacao}}</td>
                                <td>{{$func->data_visita}}</td>
                                <td>{{$func->hora_entrada}}</td>
                                <td>{{$func->hora_saida}}</td>
                                <td>{{$func->proposito_visita}}</td>
                                <td>{{$func->responsavel}}</td>
                                <td>
                                    <a href="#Cadastrar" data-toggle="modal" class="text-primary" onclick="editar({{$valor}})" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('visit.show',$func->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
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
                        <h5 class="modal-title">Cadastrar Visitantes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('visit.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nome">Nome da Actividade</label>
                            <div class="form-input">
                                <input type="text" class="form-control" name="nome" id="nome">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="empresa_organizacao">Empresa da Organização</label>
                            <div class="form-input">
                                <input type="text" class="form-control" name="empresa_organizacao" id="empresa_organizacao">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data_visita">Data</label>
                            <div class="form-input">
                                <input type="date" min="{{date('Y-m-d')}}" class="form-control" name="data_visita" id="data_visita">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hora_entrada">Hora de Entrada</label>
                            <div class="form-input">
                                <input type="time" class="form-control" name="hora_entrada" id="hora_entrada">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hora_saida">Hora de Saída</label>
                            <div class="form-input">
                                <input type="time" class="form-control" name="hora_saida" id="hora_saida">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="proposito_visita"> Proposito da Visita</label>
                            <div class="form-input">
                                <input type="text" class="form-control" name="proposito_visita" id="proposito_visita">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="responsavel">Responsavel</label>
                            <div class="form-input">
                                <select class="form-control" name="responsavel" id="responsavel">
                                    @foreach (App\Models\Funcionario::orderBy('nome','ASC')->get() as $funcio)
                                        <option value="{{$funcio->id}}">{{$funcio->nome}}</option>
                                    @endforeach
                                </select>
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
    function visitShow(valor) {
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

 <div class="modal fade" id="visit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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