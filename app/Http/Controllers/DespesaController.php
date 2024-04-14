<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmailService;
use App\Services\DespesaService;
use App\Http\Resources\DespesaResource;
use Illuminate\Support\Facades\Validator;

class DespesaController extends Controller
{
    protected $despesaService;
    protected $emailService;

    public function __construct(DespesaService $despesaService, EmailService $emailService)
    {
        $this->despesaService = $despesaService;
        $this->emailService = $emailService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $despesas = $this->despesaService->listarDespesasAutorizadas();
        return response()->json($despesas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($validacao = $this->validacao($request)){
            return $validacao->getContent();
        }

        try {
            $despesa = $this->despesaService->create($request->all());
            $this->emailService->enviarDespesaCriadaParaAdministradores($despesa);
            return response()->json(new DespesaResource($despesa), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        $validator = Validator::make($request->all(), [
            'id_cartao' => 'required|integer',
            'valor' => 'required|numeric|min:0',
            'categoria' => 'required|string',
        ], [
            'id_cartao.required' => 'O campo cartão é obrigatório.',
            'id_cartao.integer' => 'O campo cartão deve ser um número inteiro.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O campo valor deve ser numérico.',
            'valor.min' => 'O campo valor não pode ser negativo',
            'categoria.required' => 'O campo de categoria é obrigatório.',
            'categoria.string' => 'O campo categoria deve ser uma string.',
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    }
}
