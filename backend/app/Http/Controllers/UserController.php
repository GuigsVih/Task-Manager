<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Controller de usuários.
 *
 * @author Guilherme Vilela <guivo11@gmail.com>
 */
class UserController extends Controller
{
    private $_userRepository;

    /**
     * Instanciando classes.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_userRepository = new UserRepository();
    }

    /**
     * Chama repositório para registro de usuários.
     *
     * @param $request dados da requisição.
     *
     * @return void
     */
    public function register(Request $request): void
    {
        $this->_userRepository->create($request->all());
    }
}
