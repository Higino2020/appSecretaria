@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Recursos da Escola</h4>
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
                            <th>Nome do recursoo</th>
                            <th>Descrição</th>
                            <th>Tipo de Recursos</th>
                            <th>Localização</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valor as $dados)
                            <tr>
                                <td>{{$dados->nome_recurso}}</td>
                                <td>{{$dados->descricao}}</td>
                                <td>{{$dados->tipo_recurso}}</td>
                                <td>{{$dados->localizacao}}</td>
                                <td>{{$dados->status}}</td>
                                <td>
                                    <a href="#Cadastrar" data-toggle="modal" class="text-primary" onclick="editar({{$dados}})" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('recurso.show',$dados->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Cadastrar Recurso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('recurso.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                         <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="nome_recurso">Nome do Recurso</label>
                            <div class="form-input">
                                <input type="text" name="nome_recurso" id="nome_recurso" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <div class="form-input">
                                <textarea name="descricao" id="descricao" style="resize: none" class="form-control" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input">
                                <label for="localizacao">Localização</label>
                            </div>
                            <input type="text"  class="form-control" name="localizacao" id="localizacao">
                        </div>
                        <div class="form-group">
                            <label for="tipo_recurso">Tipo de Recurso</label>
                            <div class="form-input">
                                <select name="tipo_recurso" id="tipo_recurso" class="form-control">
                                    <option value="R.H">R.H</option>
                                    <option value="Finança">Finança</option>
                                    <option value="Físicos">Físicos</option>
                                    <option value="Materias e Didáticos">Materias e Didaticos</option>
                                    <option value="Pedagógicos">Pedagógicos</option>
                                    <option value="Tecnológicos">Tecnológicos</option>
                                </select>
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
        document.getElementById('nome_recurso').value = valor.nome_recurso;
        document.getElementById('descricao').value = valor.descricao;
        document.getElementById('tipo_recurso').value = valor.tipo_recurso;
        document.getElementById('localizacao').value = valor.localizacao;
        document.getElementById('status').value = valor.status;
    }
    function limpar() {
        document.getElementById('id').value = "";
        document.getElementById('nome_recurso').value = "";
        document.getElementById('descricao').value = "";
        document.getElementById('tipo_recurso').value = "";
        document.getElementById('localizacao').value = "";
        document.getElementById('status').value = "";
    }
</script>
@endsection
