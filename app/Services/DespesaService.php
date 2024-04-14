<?php

namespace App\Services;

use App\Repositories\DespesaRepository;

class DespesaService
{
    protected $despesaRepository;

    public function __construct(DespesaRepository $despesaRepository)
    {
        $this->despesaRepository = $despesaRepository;
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
        return $this->despesaRepository->create($data);
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
