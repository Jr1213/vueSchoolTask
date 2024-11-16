<?php

namespace App\Console\Commands;

use App\Jobs\SyncUserTimezonesJob;
use App\Services\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SnycUserTimezone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:snyc-user-timezone';

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
        SyncUserTimezonesJob::dispatchSync(new UserService());

    }
}
