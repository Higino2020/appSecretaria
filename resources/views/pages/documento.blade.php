@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Documentos da Escola </h4>
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
                            <th>Fichero</th>
                            <th>Tipo de Documento</th>
                            <th>Funcionario</th>
                            <th>Descrição</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doc as $dados)
                            <tr>
                                <td><a href="{{route('baixar',$dados->localizacao_arquivo)}}" class="text-danger" title="Clica para descarregar o fichero">  <i style="font-size:50px" class="fa fa-file-pdf"></i> </a></td>
                                <td>{{$dados->tipo_documento}}</td>
                                <td>{{$dados->funcionario->nome?? ''}}</td>
                                <td>{{$dados->descricao}}</td>
                                <td>{{$dados->email}}</td>
                                <td>
                                    <a href="#Cadastrar" data-toggle="modal" class="text-primary" onclick="editar({{$dados}})" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('doc.apagar',$dados->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Cadastrar Documentos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('doc.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="funcionario_id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="localizacao_arquivo">Carregue o fichero que deseja salvar</label>
                            <div class="form-input">
                                <input type="file" class="form-control" name="localizacao_arquivo" id="localizacao_arquivo">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipo_documento">Tipo de Documento</label>
                            <div class="form-input">
                                <input type="text" class="form-control" name="tipo_documento" id="tipo_documento">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <div class="form-input">
                                <textarea name="descricao" id="descricao" style="resize: none" class="form-control" cols="30" rows="4"></textarea>
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
        document.getElementById('tipo_documento').value = valor.tipo_documento;
        document.getElementById('descricao').value = valor.descricao;
    }
    function limpar() {
        document.getElementById('id').value = "";
        document.getElementById('tipo_documento').value = "";
        document.getElementById('descricao').value = "";
    }
</script>
@endsection
