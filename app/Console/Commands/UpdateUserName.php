<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class UpdateUserName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-name';

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
        User::all()->map(function ($user) use (&$query) {
            $user->update([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'timezone' => Arr::random(User::TIMEZONES),
            ]);
        });
    }
}
