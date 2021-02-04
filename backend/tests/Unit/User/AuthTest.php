<?php

namespace Tests\Unit\User;

use App\Repositories\AuthRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

/**
 * Testes de autenticação
 *
 * @author Guilherme Vilela <guivo11@gmail.com>
 */
class AuthTest extends TestCase
{
    use DatabaseTransactions;

    private $_authRepository;

    /**
     * Chamada antes dos testes
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->createUser();
        $this->_authRepository = new AuthRepository();
    }
    /**
     * Teste de Login.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = [
            'email'    => 'guivo11@gmail.com',
            'password' => '123456'
        ];

        $this->_authRepository->login($user);
        $this->assertEquals($user['email'], Auth::user()->email);
    }

    /**
     * Criar usuário para teste
     *
     * @return void
     */
    public function createUser()
    {
        $userRepository = new \App\Repository\UserRepository();

        $user = [
            'name'     => 'Guilherme',
            'lastname' => 'Vilela Oliveira',
            'email'    => 'guivo11@gmail.com',
            'password' => '123456'
        ];

        $userRepository->create($user);
    }
}
