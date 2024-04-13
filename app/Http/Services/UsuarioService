<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;

class UsuarioService
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function getAll()
    {
        return $this->usuarioRepository->getAll();
    }

    public function getById($id)
    {
        return $this->usuarioRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->usuarioRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->usuarioRepository->update($data, $id);
    }

    public function delete($id)
    {
        $this->usuarioRepository->delete($id);
    }
}
