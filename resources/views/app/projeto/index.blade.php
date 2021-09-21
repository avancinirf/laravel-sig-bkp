@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <img class="consig-icon mr-3" src="http://consigsa.test/img/consig_icon.png" />Gestão de projetos
                            <!--<a class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modal-projeto">-->
                            <a class="btn btn-sm btn-success float-right" onClick="gestaoProjetos.showModalAdicionarProjeto()">
                                <i class="bi-plus-lg"></i>
                            </a>
                        </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Iniciado em</th>
                                    <th scope="col">Finalizado em</th>
                                    <th scope="col">Público</th>
                                    <th scope="col">Usuário</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projetos as $projeto)
                                    <tr>
                                        <th scope="row">{{ $projeto->id }}</th>
                                        <td>{{ $projeto->nome }}</td>
                                        <td>{{ $projeto->descricao }}</td>
                                        <td>
                                            @if ($projeto->iniciado_em)
                                                {{ date('d/m/Y', strtotime($projeto->iniciado_em)) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($projeto->finalizado_em)
                                                {{ date('d/m/Y', strtotime($projeto->finalizado_em)) }}
                                            @endif
                                        </td>
                                        @if ($projeto->publico)
                                            <td>sim</td>
                                        @else
                                            <td>não</td>
                                        @endif
                                        <td>{{ $projeto->user_id }}</td>
                                        <td>

                                            <form id="form_{{ $projeto->id }}" >
                                                @method('DELETE')
                                                @csrf
                                                <a class="btn btn-sm btn-primary" href="{{ route('projeto.show', $projeto->id) }}"><i class="bi-eye-fill"></i></a>
                                                <a class="btn btn-sm btn-success" onClick="gestaoProjetos.showModalEditarProjeto({{$projeto}})">
                                                    <i class="bi-pencil-fill"></i>
                                                </a>
                                                <!--<a class="btn btn-sm btn-primary" href="{{ route('projeto.edit', $projeto->id) }}"><i class="bi-pencil-fill"></i></a>-->
                                                <a class="btn btn-sm btn-danger" onClick="gestaoProjetos.showModalRemoverProjeto({{$projeto}})">
                                                    <i class="bi-trash-fill"></i>
                                                </a>
                                                <!--<a class="btn btn-sm btn-danger" onclick="document.getElementById('form_{{$projeto->id}}').submit()"><i class="bi-trash-fill"></i></a>-->
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $projetos->previousPageUrl() }}">anterior</a></li>
                                @for ( $i = 1; $i <= $projetos->lastPage(); $i++ )
                                <li class="page-item {{ $projetos->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $projetos->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $projetos->nextPageUrl() }}">próxima</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>


        <!-- MODAL ADICIONAR PROJETO -->
        <div class="modal fade" id="modal-projeto" data-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Cadastrar novo Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="alert alert-success d-none" role="alert">
                    <p class="mensagem-alerta">Teste de mensagem de alerta</p>
                </div>
                    <form id="form-adicionar-projeto" >
                        @csrf
                        <div class="form-group opcoes-edicao">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control form-control-sm" name="id" id="id" disabled>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control form-control-sm" name="nome" id="nome">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Usuário</label>
                            <select class="form-control form-control-sm" name="user_id" id="user_id">
                                <option value="" selected disabled>Selecione um usuário</option>
                                @foreach ($usuarios_comuns as $usuario)
                                    <option value="{{$usuario->id}}" >{{$usuario->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control form-control-sm" name="descricao" id="descricao" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Iniciado em</label>
                            <input type="date" class="form-control" name="iniciado_em" id="iniciado_em" >
                        </div>
                        <div class="form-group">
                            <label class="form-label">Finalizado em</label>
                            <input type="date" class="form-control" name="finalizado_em" id="finalizado_em" >
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm float-left" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success btn-sm opcoes-adicionar" id="btn-cadastrar-projeto" onClick="gestaoProjetos.adicionarProjeto()">cadastrar</button>
                    <button type="button" class="btn btn-success btn-sm opcoes-edicao" id="btn-cadastrar-projeto" onClick="gestaoProjetos.editarProjeto()">salvar</button>
                    <button type="button" class="btn btn-danger btn-sm opcoes-remover" id="btn-cadastrar-projeto" onClick="gestaoProjetos.removerProjeto()">Remover</button>
                </div>
                </div>
            </div>
        </div>
        <!-- FIM MODAL ADICIONAR PROJETO -->



    </div>

    <!-- Scripts de projetos -->
    <script src="{{ asset('js/consig-app-projetos.js') }}"></script>

@endsection
