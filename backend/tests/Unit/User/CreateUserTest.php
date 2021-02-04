<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Classe de teste para criação de usuários.
 *
 * @author Guilherme Vilela <guivo11@gmail.com>
 */
class CreateUserTest extends TestCase
{
    use DatabaseTransactions;

    private $_userRepository;

    /**
     * Método chamado antes de cada teste.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->_userRepository = new UserRepository();
    }

    /**
     * Testa a crição de usuário, sem falhas.
     *
     * @return void
     */
    public function testCreateUser(): void
    {
        $user = [
            'name'      => 'Guilherme',
            'lastname'  => 'Vilela Oliveira',
            'email'     => 'guivo11@gmail.com',
            'password'  => '123456',
        ];
        $this->_userRepository->create($user);
        $userFounded = User::where('email', $user['email'])->first();

        $this->assertEquals($user['email'], $userFounded['email']);
    }

    /**
     * Falha ao criar usuário, esperando exception
     *
     * @return void
     */
    public function testFailToCreateUser(): void
    {
        $user = [
            'name'      => null,
            'lastname'  => 'Vilela Oliveira',
            'email'     => null,
            'password'  => '123456',
        ];

        $this->expectException(\Exception::class);
        $this->_userRepository->create($user);
    }

    /**
     * Criar usuário com e-mail já existente.
     *
     * @return void
     */
    public function testDuplicateMail(): void
    {
        $user = [
            'name'      => 'Guilherme',
            'lastname'  => 'Vilela Oliveira',
            'email'     => 'gvilela@mestresdeploy.com.br',
            'password'  => '123456',
        ];
        $userRepo = new UserRepository();
        $this->expectException(\Exception::class);
        $this->_userRepository->create($user);
        $userRepo->create($user);
    }

    /**
     * Criação de dois usuários.
     *
     * @return void
     */
    public function testCreateTwoUsers(): void
    {
        $userOne = [
            'name'     => 'Guilherme',
            'lastname' => 'Vilela Oliveira',
            'email'    => 'guivo@gmail.com',
            'password' => '162534'
        ];

        $userTwo = [
            'name'     => 'Mestres',
            'lastname' => 'da Web',
            'email'    => 'admin@mestresdaweb.com.br',
            'password' => '162534'
        ];

        $userRepo = new UserRepository();
        $this->_userRepository->create($userOne);
        $userRepo->create($userTwo);

        $resultOne = User::where('email', $userOne['email'])->first();
        $resultTwo = User::where('email', $userTwo['email'])->first();

        $this->assertEquals($resultOne['email'], $userOne['email']);
        $this->assertEquals($resultTwo['email'], $userTwo['email']);
    }
}
