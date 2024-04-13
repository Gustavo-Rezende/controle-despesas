<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartaoResource;
use Illuminate\Http\Request;
use App\Services\CartaoService;

class CartaoController extends Controller
{
    protected $cartaoService;

    public function __construct(CartaoService $cartaoService)
    {
        $this->cartaoService = $cartaoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartoes = $this->cartaoService->getAll();
        return response()->json($cartoes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validacao($request);

        $cartao = $this->cartaoService->create($request->all());

        return response()->json(new CartaoResource($cartao), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cartao = $this->cartaoService->getById($id);
        return new CartaoResource($cartao);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validacao($request);

        $cartao = $this->cartaoService->update($request->all(), $id);

        return response()->json(new CartaoResource($cartao), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cartaoService->delete($id);

        return response()->json(null, 204);
    }

    /**
     * Valida campos para cadastro e update.
     */
    private function validacao($request)
    {
        $request->validate([
            'id_usuario' => 'required|integer',
            'saldo' => 'required|numeric|min:0',
            'numero_cartao' => 'required|integer',
        ], [
            'id_usuario.required' => 'O campo usuário é obrigatório.',
            'id_usuario.integer' => 'O campo usuário deve ser um número inteiro.',
            'saldo.required' => 'O campo saldo é obrigatório.',
            'saldo.numeric' => 'O campo saldo deve ser numérico.',
            'saldo.min:0' => 'O campo saldo não pode ser negativo.',
            'numero_cartao.required' => 'O campo de número do cartão é obrigatório.',
            'numero_cartao.integer' => 'O campo leitor deve ser um número inteiro.',
        ]);
    }
}
