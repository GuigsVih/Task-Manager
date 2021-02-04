<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

/**
 * Teste da rota de Login.
 *
 * @author Guilherme Vilela <guivo11@gmail.com>
 */
class AuthTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * Sucesso ao logar.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->create();
        $response = $this->post(
            '/login',
            [
                'email' => 'mestres@gmail.com',
                'password' => '123456'
            ]
        );
        $response->assertStatus(200);
    }
    /**
     * Falha ao logar.
     *
     * @return void
     */
    public function testFailLogin()
    {
        Auth::logout();
        $response = $this->post(
            '/login',
            [
                'email' => 'guivo11@gmail.com',
                'password' => '456456'
            ]
        );
        $response->assertStatus(403);
    }

    /**
     * Criar usuário para teste.
     *
     * @return void
     */
    public function create()
    {
        $userRepository = new \App\Repositories\UserRepository();

        $userRepository->create(
            [
                'name' => 'Guilherme',
                'lastname' => 'Vilela Oliveira',
                'password' => '123456',
                'email'    => 'mestres@gmail.com'
            ]
        );
    }
}
