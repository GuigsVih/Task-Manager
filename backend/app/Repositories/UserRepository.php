<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Repositório para usuários, todo um CRUD.
 *
 * @author Guilherme Vilela <guivo11@gmail.com>
 */
class UserRepository
{

    private $_user;

    /**
     * Instanciar classes
     */
    public function __construct()
    {
        $this->_user = new User();
    }

    /**
     * Criar usuários
     *
     * @param $data array
     *
     * @return void
     */
    public function create(array $data): void
    {
        $this->_user->fill($data);
        $this->_user->password = Hash::make($data['password']);
        $this->_user->save();
    }

    /**
     * Listagem de usuários.
     *
     * @return array
     */
    public function findAll()
    {
        $user = User::all();
        return $user;
    }
}
