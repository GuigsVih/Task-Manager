<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Support\Facades\Validator;

/**
 * Middleware para validação de campos de registro.
 *
 * @author Guilherme Vilela <guivo11@gmail.com>
 */
class RegisterValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'name'     => 'required|max:255',
                'lastname' => 'required|max:255',
                'email'    => 'required|email|unique:users|max:255',
                'password' => 'required|min:8',
            ],
            $this->messages()
        );

        if ($validated->fails()) {
            return response()->json($validated->errors(), 500);
        }

        return $next($request);
    }

    /**
     * Mensagens de erro na validação
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'    => 'O e-mail é obrigatório.',
            'name.required'     => 'O nome é obrigatório.',
            'lastname.required' => 'O sobrenome é obrigatório.',
            'password.required' => 'A senha é obrigatória.',
            'password.min'  => 'A senha deve ter pelo menos :min caracteres.',
            'name.max'      => 'O nome deve ter no máximo 255 caracteres.',
            'lastname.max'  => 'O sobrenome deve ter no máximo 255 caracteres.',
            'email.email'   => 'E-mail inválido.',
        ];
    }
}
