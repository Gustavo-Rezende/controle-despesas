<?php

namespace App\Repositories;

use App\Models\Despesa;

class DespesaRepository
{
    protected $despesa;

    public function __construct(Despesa $despesa)
    {
        $this->despesa = $despesa;
    }

    public function create(array $data)
    {
        return $this->despesa->create($data);
    }

    public function update(array $data, $id)
    {
        $despesa = $this->despesa->findOrFail($id);
        $despesa->update($data);
        return $despesa;
    }

    public function delete($id)
    {
        $despesa = $this->despesa->findOrFail($id);
        $despesa->delete();
        return true;
    }

    public function getById($id)
    {
        return $this->despesa->findOrFail($id);
    }

    public function getAll()
    {
        return $this->despesa->all();
    }

    public function getDespesaByUser($id) {
        return $this->despesa->select('despesa.*')
                       ->join('cartao', 'despesa.id_cartao', '=', 'cartao.id')
                       ->join('users', 'cartao.id_user', '=', 'users.id')
                       ->where('users.id', $id)
                       ->get();
    }
}
