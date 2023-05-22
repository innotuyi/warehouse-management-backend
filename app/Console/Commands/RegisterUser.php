<?php

namespace App\Console\Commands;

use App\Service\AuthService;
use Illuminate\Console\Command;

class RegisterUser extends Command
{

    protected $signature = 'register:user {role} {name} {email} {password}';

    protected $description = 'Register a new user with the specified role (customer or admin)';


    public function handle(AuthService $service)
    {

        $role = $this->argument('role');
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        if ($role === 'customer') {
            $user = $service->registerCustomer($name, $email, $password);
        } elseif ($role === 'admin') {
            $user = $service->registerAdmin($name, $email, $password);
        } else {
            $this->error('Invalid role specified.');
            return;
        }

        $this->info('User registered successfully.');
        $this->line('User ID: ' . $user->id);
        $this->line('Name: ' . $user->name);
        $this->line('Email: ' . $user->email);
        $this->line('Role: ' . $user->role);
    }
}
