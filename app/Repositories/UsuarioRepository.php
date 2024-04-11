<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    protected $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function create(array $data)
    {
        return $this->usuario->create($data);
    }

    public function update(array $data, $id)
    {
        $usuario = $this->usuario->findOrFail($id);
        $usuario->update($data);
        return $usuario;
    }

    public function delete($id)
    {
        $usuario = $this->usuario->findOrFail($id);
        $usuario->delete();
        return true;
    }

    public function getById($id)
    {
        return $this->usuario->findOrFail($id);
    }

    public function getAll()
    {
        return $this->usuario->all();
    }
}
