<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\CartaoRepository;
use App\Repositories\DespesaRepository;

class DespesaService
{
    protected $despesaRepository;
    protected $cartaoRepository;

    public function __construct(DespesaRepository $despesaRepository, CartaoRepository $cartaoRepository)
    {
        $this->despesaRepository = $despesaRepository;
        $this->cartaoRepository = $cartaoRepository;
    }

    public function listarDespesasAutorizadas()
    {
        $usuario = auth()->user();

        if ($usuario->tipo === 'administrador') {
            return $this->despesaRepository->getAll();
        }

        return $this->despesaRepository->getDespesaByUser($usuario->id);
    }

    public function getAll()
    {
        return $this->despesaRepository->getAll();
    }

    public function getById($id)
    {
        return $this->despesaRepository->getById($id);
    }

    public function create(array $data)
    {
        $cartao = $this->cartaoRepository->getById($data['id_cartao']);

        if ($cartao->saldo < $data['valor']) {
            throw new \Exception('Saldo insuficiente');
        }

        DB::beginTransaction();

        try {
            $cartao->saldo -= $data['valor'];
            $this->cartaoRepository->update(['saldo' => $cartao->saldo], $cartao->id);

            $despesa = $this->despesaRepository->create($data);

            DB::commit();

            return $despesa;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro ao criar a despesa '.$e->getMessage());
        }
    }

    public function update(array $data, $id)
    {
        return $this->despesaRepository->update($data, $id);
    }

    public function delete($id)
    {
        $this->despesaRepository->delete($id);
    }
}
