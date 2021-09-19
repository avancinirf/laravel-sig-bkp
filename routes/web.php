<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogAcessoMiddleware;
use App\Http\Middleware\IsAdminMiddleware;
use App\Mail\MensagemTesteMail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::middleware(LogAcessoMiddleware::class)->get('/', function () { return view('welcome'); });

/* Rotas públicas do SITE */
Route::get('/', function() { return View('site.index'); })->name('site.index');
Route::get('/contato', function() { return View('site.contato'); })->name('site.contato');
Route::get('/sobre', function() { return View('site.sobre'); })->name('site.sobre');

/* Rotas de e-mails */
Route::get('mensagem-teste', function() {
    return new MensagemTesteMail();
    //Mail::to('avancini.rf@gmail.com')->send(new MensagemTesteMail());
    //return 'Mensagem de teste enviada com sucesso!!!';
});


Auth::routes(['verify' => true]);

/* Rotas privadas da APP */
Route::middleware(['auth', 'verified'])->prefix('/app')->group(function() {
    /* Rotas para todos os usuários cadastrados no sistema */
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('meus-projetos', [App\Http\Controllers\ProjetoController::class, 'meusProjetos'])->name('meus.projetos');

    /* Rotas para usuários cadastrados no sistema como ADMIN */
    Route::resource('projeto', 'ProjetoController')->middleware('is.admin');
    Route::resource('arquivo', 'ArquivoController')->middleware('is.admin');
    Route::resource('geometria', 'GeometriaController')->middleware('is.admin');
});




/* TODO: Implementar uma página de 404 customizada
Route::fallback(function() {
    return View('pagina_de_erro');
});*/
