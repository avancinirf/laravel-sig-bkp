@component('mail::message')
# Introdução da mensagem

Corpo da mensagem.

@component('mail::button', ['url' => ''])
Botão de teste
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
