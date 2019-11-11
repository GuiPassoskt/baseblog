<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('make:user', function () {
    
    $email = $this->ask('Digite um e-mail');

    $name = $this->ask('Digite o nome');

    $password = bcrypt($this->secret('Digite a senha'));

    $api_token = str_random(80);

    $user = \App\Models\User::firstOrNew(compact('email'));

    $user->fill(compact('name', 'password', 'api_token'))->save();

    $this->info('Usuário criado com sucesso!');

})->describe('Cria um usuário pela linha de comando');
