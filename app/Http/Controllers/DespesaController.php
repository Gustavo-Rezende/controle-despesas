<?php

namespace App\Http\Controllers;

use App\Http\Resources\DespesaResource;
use App\Models\Despesa;
use App\Repositories\DespesaRepository;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    protected $despesaRepository;

    public function __construct(DespesaRepository $despesaRepository)
    {
        $this->despesaRepository = $despesaRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $despesas = $this->despesaRepository->getAll();
        return DespesaResource::collection($despesas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validacao($request);

        $despesa = $this->despesaRepository->create($request->all());

        return response()->json(new DespesaResource($despesa), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $despesa = $this->despesaRepository->getById($id);
        return new DespesaResource($despesa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validacao($request);

        $despesa = $this->despesaRepository->update($request->all(), $id);

        return response()->json(new DespesaResource($despesa), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->despesaRepository->delete($id);

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
