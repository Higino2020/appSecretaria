@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Financiamento da Escola</h4>
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
                            <th>Tipo de Transição</th>
                            <th>Data</th>
                            <th>Valor</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Responsavel</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valor as $dados)
                            <tr>
                                <td>{{$dados->tipo_transacao}}</td>
                                <td>{{$dados->data}}</td>
                                <td>{{$dados->valor}}</td>
                                <td>{{$dados->descricao}}</td>
                                <td>{{$dados->categoria}}</td>
                                <td>{{$dados->funcionario->nome}}</td>
                                <td>
                                    <a href="#Cadastrar" data-toggle="modal" class="text-primary" onclick="editar({{$dados}})" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('financ.apagar',$dados->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Cadastrar Financiamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('financ.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                         <input type="hidden" name="id" id="id">
                         <div class="form-group">
                            <label for="tipo_transacao">Tipo de Transição</label>
                            <div class="form-input">
                                <select name="tipo_transacao" id="tipo_transacao" class="form-control">
                                    <option value="Transferençia">Transferençia</option>
                                    <option value="Moeda">Moeda</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <div class="form-input">
                                <input type="number" name="valor" id="valor" class="form-control" />
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
                                <label for="data">Data</label>
                            </div>
                            <input type="date" min="{{date('Y-m-d')}}" class="form-control" name="data" id="data">
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <div class="form-input">
                                <select name="categoria" id="categoria" class="form-control">
                                    <option value="Activo">Activo</option>
                                    <option value="Passivo">Passivo</option>
                                </select>
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
        document.getElementById('tipo_transacao').value = valor.tipo_transacao;
        document.getElementById('data').value = valor.data;
        document.getElementById('valor').value = valor.valor;
        document.getElementById('descricao').value = valor.descricao;
        document.getElementById('categoria').value = valor.categoria;
        document.getElementById('responsavel').value = valor.responsavel;
    }
    function limpar() {
        document.getElementById('id').value = "";
        document.getElementById('tipo_transacao').value = "";
        document.getElementById('data').value = "";
        document.getElementById('valor').value = "";
        document.getElementById('descricao').value = "";
        document.getElementById('categoria').value = "";
        document.getElementById('responsavel').value = "";
    }
</script>
@endsection
