<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdminMiddleware;
use App\Models\User;


class ProjetoController extends Controller
{
    public function __construct(Projeto $projeto) {
        $this->projeto = $projeto;
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
        $usuariosComuns = User::select('id', 'name')->where('admin', '=', false)->orderBy('name')->get();

        if (!auth()->user()->admin) {
            $projetos = $this->projeto->where('user_id', '=', auth()->user()->id)->orderBy('nome')->paginate(10);
        } else {
            $projetos = $this->projeto->orderBy('nome')->paginate(10);
        }
        $data = ['projetos' => $projetos, 'usuarios_comuns' => $usuariosComuns];

        return view('app.projeto.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuariosComuns = User::select('id', 'name')->where('admin', '=', false)->orderBy('name')->get();
        return view('app.projeto.create', ['usuarios' => $usuariosComuns]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->projeto->rules(), $this->projeto->feedback());

        $projeto = $this->projeto->create($request->all());

        return redirect()->route('projeto.show', ['projeto' => $projeto->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projeto = $this->projeto->find($id);

        if ($projeto === null) {
            return view('app.projeto.show');
        }
        return view('app.projeto.show', ['projeto' => $projeto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Projeto $projeto)
    {
        return view('app.projeto.edit', ['projeto' => $projeto]);
    }*/
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projeto = $this->projeto->find($id);
        if (!$projeto) {
            return view('app.projeto.edit');
        }
        return view('app.projeto.edit', ['projeto' => $projeto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $projeto = $this->projeto->find($id);

        if ($projeto === null) {
            return view('app.projeto.edit');
        }

        $request->validate($this->projeto->rules(), $this->projeto->feedback());
        $projeto->update($request->all());

        return redirect()->route('projeto.show', ['projeto' => $projeto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projeto = $this->projeto->find($id);
        if ($projeto === null) {
            return redirect()->route('projeto.index');
        }

        $projeto->delete();
        return redirect()->route('projeto.index');
    }

    public function listaSimplesDeUsuarios() {
        // TODO : Rever a função e necessidade de implementar.
        $usuarios = User::select('id', 'name')->where('admin', '=', false)->get();
        return json_encode($usuarios);
    }
}
