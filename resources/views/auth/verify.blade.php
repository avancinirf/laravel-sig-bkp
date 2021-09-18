@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><img class="consig-icon mr-3" src="http://consigsa.test/img/consig_icon.png" />Verificação de e-mail</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Um link de verificação foi enviado para sua caixa de e-mails.
                        </div>
                    @endif
                    Antes de prosseguir, verifique sua caixa de e-mail para prosseguir com o processo de validação de conta.</br>
                    Esse processo leva poucos segundos e garante a segurança de sua conta.</br></br>
                    Caso não tenha recebido o e-mail de verificação,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">clique aqui para reenviarmos o e-mail</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
