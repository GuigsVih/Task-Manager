<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Testes da rota '/register'
 *
 * @author Guilherme Vilela <guivo11@gmail.com>
 */
class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Sucesso ao utilizar a rota.
     *
     * @return void
     */
    public function testRegisterSuccess()
    {
        $response = $this->post(
            '/register',
            [
                'email' => 'guivo11@gmail.com',
                'name'  => 'Guilherme',
                'lastname' => 'Vilela Oliveira',
                'password' => '12345678'
            ]
        );
        $response->assertStatus(200);
    }

    /**
     * Middleware de validação falha e retorna código 500.
     *
     * @return void
     */
    public function testRegisterMiddlewareFail()
    {
        $response = $this->post('/register', ['email' => null]);
        $response->assertStatus(500);
    }
}
