<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderID = Aluno:: orderByDesc('id')->get();
        return view('Aluno.Index', compact('orderId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       return view('Alunos.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'=> ['required', 'string', 'max:150'],
            'email' =>['required', 'string', 'max:250'],
            'birthday' =>['required', 'date', 'before:today'],
        ]);

        Aluno::create([
            'nome' => $validated['nome'],
            'email' =>$validated['email'],
            'birthday' => $validated['birthday'],
        ]);
        return redirect()->route('Alunos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Aluno = Aluno::findOrFail($id);
        return view('Alunos.edit', compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:alunos,nome', 'string', 'max:150'],
            'email' => ['required', 'unique:alunos,email', 'string', 'max:200'],
            'birthday' => ['required', 'unique:alunos,birthday','date', 'before:today'],
        ]);
        $aluno = Aluno::findOrFail($id);
        $aluno->update([
            'nome' =>validated['nome'],
            'email' =>$validated['email'],
            'birthday' => $validated['birthday'],
        ]);
        return redirect()->route('alunos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        return redirect()->route('alunos.index');
    }
}
