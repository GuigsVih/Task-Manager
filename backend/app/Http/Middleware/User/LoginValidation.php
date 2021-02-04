<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Support\Facades\Validator;

class LoginValidation
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
                'email' => 'required|email',
                'password' => 'required'
            ],
            $this->messages()
        );

        if ($validated->fails()) {
            return response()->json($validated->errors(), 500);
        }

        return $next($request);
    }

    /**
     * Mensagens da validação com erros.
     *
     * @return array
     */
    public function messages() : array
    {
        return [
            'email.required' => 'O e-mail é obrigatório.',
            'email.email'    => 'O e-mail é inválido.',
            'password.required' => 'A senha é obrigatória.'
        ];
    }
}
