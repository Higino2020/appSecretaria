@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Correspondênçia da Empresa</h4>
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
                            <th>Tipo</th>
                            <th>Assunto</th>
                            <th>Descrição</th>
                            <th>Remetente</th>
                            <th>Data</th>
                            <th>Destinatário</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valor as $dados)
                            <tr>
                                <td>{{$dados->tipo}}</td>
                                <td>{{$dados->assunto}}</td>
                                <td>{{$dados->descricao}}</td>
                                <td>{{$dados->remetente}}</td>
                                <td>{{$dados->data}}</td>
                                <td>{{$dados->funcionario->nome??""}}</td>
                                <td>
                                    <a href="#Cadastrar" data-toggle="modal" class="text-primary" onclick="editar({{$dados}})" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('corresp.apagar',$dados->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Cadastrar Correspondênçia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('corresp.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                         <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <div class="form-input">
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="Interna">Interna</option>
                                    <option value="Externa">Externa</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="assunto">Assunto</label>
                            <div class="form-input">
                                <input type="text" name="assunto" id="assunto" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <div class="form-input">
                                <textarea name="descricao" id="descricao" style="resize: none" class="form-control" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remetente">Remetente</label>
                            <div class="form-input">
                                <input type="text" name="remetente" id="remetente"  class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data">Data</label>
                            <div class="form-input">
                                <input type="date" min="{{date('Y-m-d')}}" class="form-control" name="data" id="data">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="destinatario">Destinatário</label>
                            <div class="form-input">
                                <select class="form-control" name="destinatario" id="destinatario">
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
        document.getElementById('tipo').value = valor.tipo;
        document.getElementById('assunto').value = valor.assunto;
        document.getElementById('descricao').value = valor.descricao;
        document.getElementById('remetente').value = valor.remetente;
        document.getElementById('data').value = valor.data;
        document.getElementById('destinatario').value = valor.destinatario;
    }
    function limpar() {
        document.getElementById('id').value = "";
        document.getElementById('tipo').value = "";
        document.getElementById('assunto').value = "";
        document.getElementById('descricao').value = "";
        document.getElementById('remetente').value = "";
        document.getElementById('data').value = "";
        document.getElementById('destinatario').value = "";
    }
</script>
@endsection
