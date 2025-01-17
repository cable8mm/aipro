<?php

namespace App\Console\Commands;

use App\Enums\UserType;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Util;

class CreateNovaAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aipro:create-nova-account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = env('NOVA_NAME');
        $email = env('NOVA_EMAIL');
        $password = env('NOVA_PASSWORD');

        if (! empty($name) && ! empty($email) && ! empty($password)) {
            $model = Util::userModel();

            try {
                tap((new $model)->forceFill([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'type' => UserType::ADMINISTRATOR->name,
                ]))->save();
            } catch (QueryException $e) {

            }
        }
    }
}
