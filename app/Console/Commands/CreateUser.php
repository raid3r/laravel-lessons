<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {userName} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new application user';

    /**
     * Execute the console command.
     */
    public function handle()
    {


        $user = new User();
        $user->name = $this->argument('userName');
        $user->email = $this->argument('email');


        $this->line("Create user {$user->name} {$user->email}");
        $password = $this->secret("Password: ");
        $user->password = Hash:: make($password);

        if ($user->save()) {
            $this->line("Created");
        } else {
            $this->error("User not created");
        }
    }
}
