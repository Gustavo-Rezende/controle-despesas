<?php

namespace App\Services;

use App\Repositories\CartaoRepository;

class CartaoService
{
    protected $cartaoRepository;

    public function __construct(CartaoRepository $cartaoRepository)
    {
        $this->cartaoRepository = $cartaoRepository;
    }

    public function getAll()
    {
        return $this->cartaoRepository->getAll();
    }

    public function getById($id)
    {
        return $this->cartaoRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->cartaoRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->cartaoRepository->update($data, $id);
    }

    public function delete($id)
    {
        $this->cartaoRepository->delete($id);
    }
}
