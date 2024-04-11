<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UsuarioResource;
use App\Repositories\UsuarioRepository;

class UsusarioController extends Controller
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = $this->usuarioRepository->getAll();
        return UsuarioResource::collection($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validacao($request);

        $usuario = $this->usuarioRepository->create($request->all());

        return response()->json(new UsuarioResource($usuario), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = $this->usuarioRepository->getById($id);
        return new UsuarioResource($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validacao($request);

        $usuario = $this->usuarioRepository->update($request->all(), $id);

        return response()->json(new UsuarioResource($usuario), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->usuarioRepository->delete($id);

        return response()->json(null, 204);
    }

    /**
     * Valida campos para cadastro e update.
     */
    private function validacao($request)
    {
        $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:usuario,email,',
            'tipo' => 'required|string',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'Este endereço de e-mail já está em uso. Por favor, escolha outro.',
            'tipo.required' => 'O campo de tipo é obrigatório.',
            'tipo.string' => 'O campo tipo deve ser uma string.',
        ]);
    }
}
