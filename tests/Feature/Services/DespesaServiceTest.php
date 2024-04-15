<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\User;
use App\Models\Cartao;
use App\Models\Despesa;
use App\Services\DespesaService;
use App\Repositories\CartaoRepository;
use App\Repositories\DespesaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DespesaServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected $despesaService;

    public function setUp(): void
    {
        parent::setUp();

        // Use a implementação real do repository
        $despesaRepository = new DespesaRepository(new Despesa());
        $cartaoRepository = new CartaoRepository(new Cartao());

        $this->despesaService = new DespesaService($despesaRepository, $cartaoRepository);
    }

    public function testCreateComSaldoSuficiente()
    {
        $cartao = Cartao::factory()->create(['saldo' => 200]);

        $data = [
            'id_cartao' => $cartao->id,
            'valor' => 100,
            'categoria' => 'combustivel'
        ];

        $despesa = $this->despesaService->create($data);

        $this->assertInstanceOf(Despesa::class, $despesa);
        $this->assertEquals(100, $cartao->refresh()->saldo);
    }


    public function testCreateComSaldoInsuficiente()
    {
        $cartao = Cartao::factory()->create(['saldo' => 50]);

        $data = [
            'id_cartao' => $cartao->id,
            'valor' => 100,
            'categoria' => 'alimentacao'
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Saldo insuficiente');

        $this->despesaService->create($data);
    }

    public function testUpdateDespesa()
    {
        $despesa = Despesa::factory()->create();

        $data = [
            'valor' => 150,
            'categoria' => 'alimentacao'
        ];

        $this->despesaService->update($data, $despesa->id);

        $despesaAtualizada = Despesa::find($despesa->id);

        $this->assertEquals(150, $despesaAtualizada->valor);
        $this->assertEquals('alimentacao', $despesaAtualizada->categoria);
    }

    public function testDeleteDespesa()
    {
        $despesa = Despesa::factory()->create();

        $this->despesaService->delete($despesa->id);

        $this->assertNull(Despesa::find($despesa->id));
    }

}
