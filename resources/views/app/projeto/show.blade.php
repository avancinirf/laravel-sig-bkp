@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><img class="consig-icon mr-3" src="http://consigsa.test/img/consig_icon.png" />{{ $projeto->nome }}</div>

                    <div class="card-body">
                        <fieldset disabled>
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $projeto->nome }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Usuário</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $projeto->user_id }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" rows="3">{{ $projeto->descricao }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Iniciado em</label>
                                <input type="date" class="form-control" value="{{ $projeto->iniciado_em }}" >
                            </div>
                            <div class="form-group">
                                <label class="form-label">Finalizado em</label>
                                <input type="date" class="form-control" value="{{ $projeto->finalizado_em }}" >
                            </div>
                        </fieldset>
                        <a href="{{ route('projeto.index') }}" class="btn btn-sm px-3 btn-primary">Lista de projetos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
