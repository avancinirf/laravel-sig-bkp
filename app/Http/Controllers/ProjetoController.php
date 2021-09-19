<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdminMiddleware;


class ProjetoController extends Controller
{
    public function __construct() {
        //$this->middleware(IsAdminMiddleware::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //throw new \Exception('Erro ao adicionar projeto!');
        if (!auth()->user()->admin) {
            $projetos = Projeto::where('user_id', '=', auth()->user()->id)->paginate(10);
        } else {
            $projetos = Projeto::paginate(10);
        }
        return view('app.projeto.index', ['projetos' => $projetos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('app.projeto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projeto = Projeto::create($request->all());
        return redirect()->route('projeto.show', ['projeto' => $projeto->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    public function show(Projeto $projeto)
    {
        return view('app.projeto.show', ['projeto' => $projeto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    public function edit(Projeto $projeto)
    {
        return view('app.projeto.edit', ['projeto' => $projeto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projeto $projeto)
    {
        $projeto->update($request->all());
        return redirect()->route('projeto.show', ['projeto' => $projeto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projeto $projeto)
    {
        $projeto->delete();
        return redirect()->route('projeto.index');
    }

    public function meusProjetos() {
        dd('teste P ok!!!');
    }
}
