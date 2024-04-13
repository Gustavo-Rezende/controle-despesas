<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DespesaService;
use App\Http\Resources\DespesaResource;

class DespesaController extends Controller
{
    protected $despesaService;

    public function __construct(DespesaService $despesaService)
    {
        $this->despesaService = $despesaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $despesas = $this->despesaService->getAll();
        return response()->json($despesas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validacao($request);

        $despesa = $this->despesaService->create($request->all());

        return response()->json(new DespesaResource($despesa), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $despesa = $this->despesaService->getById($id);
        return response()->json($despesa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validacao($request);

        $despesa = $this->despesaService->update($request->all(), $id);

        return response()->json(new DespesaResource($despesa), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->despesaService->delete($id);
        return response()->json(null, 204);
    }

    /**
     * Valida campos para cadastro e update.
     */
    private function validacao($request)
    {
        $request->validate([
            'id_cartao' => 'required|integer|unique:cartao',
            'valor' => 'required|numeric|min:0',
            'categoria' => 'required|string',
        ], [
            'id_cartao.required' => 'O campo cartão é obrigatório.',
            'id_cartao.integer' => 'O campo cartão deve ser um número inteiro.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O campo valor deve ser numérico.',
            'valor.min:0' => 'O campo valor não pode ser negativo',
            'categoria.required' => 'O campo de categoria é obrigatório.',
            'categoria.string' => 'O campo categoria deve ser uma string.',
        ]);
    }
}
