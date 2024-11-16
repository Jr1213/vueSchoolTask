<?php

namespace App\Jobs;

use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SyncUserTimezonesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly UserService $userService)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->userService->snycUsersTimezone();
    }
}
