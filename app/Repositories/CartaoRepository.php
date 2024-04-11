<?php

namespace App\Repositories;

use App\Models\Cartao;

class CartaoRepository
{
    protected $cartao;

    public function __construct(Cartao $cartao)
    {
        $this->cartao = $cartao;
    }

    public function create(array $data)
    {
        return $this->cartao->create($data);
    }

    public function update(array $data, $id)
    {
        $cartao = $this->cartao->findOrFail($id);
        $cartao->update($data);
        return $cartao;
    }

    public function delete($id)
    {
        $cartao = $this->cartao->findOrFail($id);
        $cartao->delete();
        return true;
    }

    public function getById($id)
    {
        return $this->cartao->findOrFail($id);
    }

    public function getAll()
    {
        return $this->cartao->all();
    }
}
