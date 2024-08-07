@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Pautas da Escola</h4>
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
                            <th>Disciplina</th>
                            <th>1ª Nota</th>
                            <th>2ª Nota</th>
                            <th>Exame</th>
                            <th>Final</th>
                            <th>Período</th>
                            <th>Estado</th>
                            <th>Professor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paut as $dados)
                            <tr>
                                <td>{{$dados->estudante_id}}</td>
                                <td>{{$dados->disciplina_id}}</td>
                                <td>{{$dados->prova1}}</td>
                                <td>{{$dados->prova2}}</td>
                                <td>{{$dados->exame}}</td>
                                <td>{{$dados->final}}</td>
                                <td>{{$dados->periodo}}</td>
                                <td>{{$dados->final}}</td>
                                <td>{{$dados->status}}</td>
                                <td>{{$dados->funcionario->nome}}</td>
                                <td>
                                    <a href="#Cadastrar" data-toggle="modal" class="text-primary" onclick="editar({{$dados}})" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('paut.apagar',$dados->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Cadastrar Pautas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('paut.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                         <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="responsavel">Estudante</label>
                            <div class="form-input">
                                <select class="form-control" name="responsavel" id="responsavel">
                                    @foreach (App\Models\estudante::orderBy('nome','ASC')->get() as $estudante_id)
                                        <option value="{{$estudante_id->id}}">{{$estudante_id->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="responsavel">Disciplina</label>
                            <div class="form-input">
                                <select class="form-control" name="responsavel" id="responsavel">
                                    @foreach (App\Models\Disciplina::orderBy('nome_disciplina','ASC')->get() as $disciplina_id)
                                        <option value="{{$disciplina_id->id}}">{{$disciplina_id->nome_disciplina}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nome_projeto">Primeira Prova</label>
                            <div class="form-input">
                                <input type="number" name="nome_projeto" id="nome_projeto" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Segunda Prova</label>
                            <div class="form-input">
                                <input type="number" name="nome_projeto" id="nome_projeto" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data_inicio">Exame</label>
                            <div class="form-input">
                                <input type="number"  class="form-control" name="data_inicio" id="data_inicio">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-input">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Selecionar o Período</option>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Selecionar Estado</option>
                                    <option value="Aprovado">Aprovado</option>
                                    <option value="Reprovado">Reprovado</option>
                                    <option value="Desistido">Desistido</option>
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
