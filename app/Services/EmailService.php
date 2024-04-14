<?php

namespace App\Services;

use App\Models\User;
use App\Models\Despesa;
use App\Repositories\UsuarioRepository;
use App\Mail\DespesaCriadaEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function enviarDespesaCriadaParaAdministradores(Despesa $despesa)
    {
        $administradores = $this->usuarioRepository->buscarAdministradores();

        foreach ($administradores as $administrador) {
            Mail::to($administrador->email)->send(new DespesaCriadaEmail($despesa));
        }
    }
}
