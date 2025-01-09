@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Faltas dos Estudantes</h4>
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
                            <th>Estudante</th>
                            <th>Qtd de faltas</th>
                            <th>Data</th>
                            <th>Professor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valor as $dados)
                            <tr>
                                <td>{{$dados->estudante->nome}}</td>
                                <td>{{$dados->qtd_falta}}</td>
                                <td>{{$dados->data}}</td>
                                <td>{{$dados->funcionario->nome}}</td>
                                <td>
                                    <a href="#Cadastrar" data-toggle="modal" class="text-primary" onclick="editar({{$dados}})" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('falt.apagar',$dados->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Cadastrar Faltas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('falt.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                         <input type="hidden" name="id" id="id">
                         <div class="form-group">
                            <label for="estudantes_Id">Estudante</label>
                            <div class="form-input">
                                <select class="form-control" name="estudantes_Id" id="estudantes_Id">
                                    @foreach (App\Models\estudante::orderBy('nome','ASC')->get() as $estudante_id)
                                        <option value="{{$estudante_id->id}}">{{$estudante_id->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qtd_falta">Quantidade de Faltas</label>
                            <div class="form-input">
                                <input type="text" name="qtd_falta" id="qtd_falta" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data">Data</label>
                            <div class="form-input">
                                <input type="date" name="data" id="data" class="form-control" />
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <x-botao-form />
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editar(valor) {
        document.getElementById('id').value = valor.id;
        document.getElementById('estudantes_Id').value = valor.estudante_id;
        document.getElementById('qtd_falta').value = valor.qtd_falta;
        document.getElementById('data').value = valor.data;
    }
    function limpar() {
        document.getElementById('id').value = "";
        document.getElementById('estudantes_Id').value = "";
        document.getElementById('qtd_falta').value = "";
        document.getElementById('data').value = "";
    }
</script>
@endsection
