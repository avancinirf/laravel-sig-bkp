@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><img class="consig-icon mr-3" src="http://consigsa.test/img/consig_icon.png" />Editar projeto</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('projeto.update', ['projeto' => $projeto->id]) }}" >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" name="nome" id="nome" value="{{ $projeto->nome }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Usuário</label>
                                <select class="form-control form-control-sm" name="user_id" id="user_id">
                                    <option value="" selected disabled>Selecione um usuário</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" name="descricao" id="descricao" rows="3">{{ $projeto->descricao }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Iniciado em</label>
                                <input type="date" class="form-control" name="iniciado_em" id="iniciado_em" value="{{ $projeto->iniciado_em }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Finalizado em</label>
                                <input type="date" class="form-control" name="finalizado_em" id="finalizado_em" value="{{ $projeto->finalizado_em }}">
                            </div>
                            <a href="{{ url()->previous() }}" class="btn btn-sm px-3 btn-primary">Lista de projetos</a>
                            <button type="submit" class="btn btn-sm px-3 btn-primary float-right">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
