@extends('layouts.base')

@section('secretaria')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title" style="display: flex; justify-content: space-between; width: 100%">
                    <h4 class="card-title">Visitantes da Escola</h4>
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
                            <th>Empresa Organizadora</th>
                            <th>Data da Visita</th>
                            <th>Hora de Entrada</th>
                            <th>Hora de Saída</th>
                            <th>Proposito da Visita</th>
                            <th>Responsável</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valor as $dados)
                            <tr>
                                <td>{{$dados->nome}}</td>
                                <td>{{$dados->empresa_organizacao}}</td>
                                <td>{{$dados->data_visita}}</td>
                                <td>{{$dados->hora_entrada}}</td>
                                <td>{{$dados->hora_saida}}</td>
                                <td>{{$dados->proposito_visita}}</td>
                                <td>{{$dados->funcionario->nome}}</td>
                                <td>
                                    <a href="#Cadastrar" data-toggle="modal" class="text-primary" onclick="editar({{$dados}})" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('visit.apagar',$dados->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Cadastrar Vistantes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                   <form action="{{route('visit.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                         <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <div class="form-input">
                                <input type="text" name="nome" id="nome" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="empresa_organizacao">Empresa da Organização</label>
                            <div class="form-input">
                                <input type="text" name="empresa_organizacao" id="empresa_organizacao" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data_visita">Data da Visita</label>
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
                            <label for="proposito_visita">Proposito da Visita</label>
                            <div class="form-input">
                                <input type="text" name="proposito_visita" id="proposito_visita"  class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="responsavel">Responsavel da Visita</label>
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
                <x-botao-form />
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editar(valor) {
        document.getElementById('id').value = valor.id;
        document.getElementById('nome').value = valor.nome;
        document.getElementById('empresa_organizacao').value = valor.empresa_organizacao;
        document.getElementById('data_visita').value = valor.data_visita;
        document.getElementById('hora_entrada').value = valor.hora_entrada;
        document.getElementById('hora_saida').value = valor.hora_saida;
        document.getElementById('proposito_visita').value = valor.proposito_visita;
        document.getElementById('responsavel').value = valor.responsavel;
    }
    function limpar() {
        document.getElementById('id').value = "";
        document.getElementById('nome').value = "";
        document.getElementById('empresa_organizacao').value = "";
        document.getElementById('data_visita').value = "";
        document.getElementById('hora_entrada').value = "";
        document.getElementById('hora_saida').value = "";
        document.getElementById('proposito_visita').value = "";
        document.getElementById('responsavel').value = "";
    }
</script>
@endsection
