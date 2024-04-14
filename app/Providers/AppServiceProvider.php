<?php

namespace App\Providers;

use App\Models\Cartao;
use App\Models\Despesa;
use App\Services\EmailService;
use App\Repositories\CartaoRepository;
use App\Repositories\DespesaRepository;
use App\Repositories\UsuarioRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CartaoRepository::class, function ($app) {
            return new CartaoRepository(new Cartao());
        });

        $this->app->bind(DespesaRepository::class, function ($app) {
            return new DespesaRepository(new Despesa());
        });

        $this->app->singleton(EmailService::class, function ($app) {
            return new EmailService($app->make(UsuarioRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
