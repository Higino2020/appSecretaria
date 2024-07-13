@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Projecto da Escola</h4>
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
                            <th>Nome do Projecto</th>
                            <th>Descrição</th>
                            <th>Data de Inicio</th>
                            <th>Data de Termino</th>
                            <th>Estado</th>
                            <th>Responsável</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valor as $dados)
                            <tr>
                                <td>{{$dados->nome_projeto}}</td>
                                <td>{{$dados->descricao}}</td>
                                <td>{{$dados->data_inicio}}</td>
                                <td>{{$dados->data_termino}}</td>
                                <td>{{$dados->status}}</td>
                                <td>{{$dados->responsavel}}</td>
                                <td>
                                    <a href="#Cadastrar" data-toggle="modal" class="text-primary" onclick="editar({{$dados}})" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('project.show',$dados->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Cadastrar Projecto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('project.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                         <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="nome_projeto">Nome do Projecto</label>
                            <div class="form-input">
                                <input type="text" name="nome_projeto" id="nome_projeto" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <div class="form-input">
                                <textarea name="descricao" id="descricao" style="resize: none" class="form-control" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data_inicio">Data de Inicio</label>
                            <div class="form-input">
                                <input type="date" min="{{date('Y-m-d')}}" class="form-control" name="data_inicio" id="data_inicio">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data_termino">Data de Termino</label>
                            <div class="form-input">
                                <input type="date" min="{{date('Y-m-d')}}" class="form-control" name="data_termino" id="data_termino">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <div class="form-input">
                                <select name="status" id="status" class="form-control">
                                    <option value="Activo">Activo</option>
                                    <option value="Não Activo">Não Activo</option>
                                    <option value="Pendente">Pendente</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="responsavel">Responsavel do Projecto</label>
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
        document.getElementById('nome_projeto').value = valor.nome_projeto;
        document.getElementById('descricao').value = valor.descricao;
        document.getElementById('data_inicio').value = valor.data_inicio;
        document.getElementById('data_termino').value = valor.data_termino;
        document.getElementById('status').value = valor.status;
        document.getElementById('responsavel').value = valor.responsavel;
    }
    function limpar() {
        document.getElementById('id').value = "";
        document.getElementById('nome_projeto').value = "";
        document.getElementById('descricao').value = "";
        document.getElementById('data_inicio').value = "";
        document.getElementById('data_termino').value = "";
        document.getElementById('status').value = "";
        document.getElementById('responsavel').value = "";
    }
</script>
@endsection
