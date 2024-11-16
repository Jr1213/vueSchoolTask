<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserService
{
    
    public function snycUsersTimezone(): void
    {
        User::where('updated_at', '>=', now()->subHour())->chunk(1000, function ($users) {
            $data = $users->map(function ($user) {
                return [
                    'email' => $user->email,
                    'name' => $user->first_name,
                    'time_zone' => $user->timezone,
                ];
            });
                
            $this->callUpdateApi([
                "batches" => [[
                    "subscribers" => $data
                ]
            ]]);
        });
    }

    private function callUpdateApi($data = [], $hreaders = []): void {
        $hreaders = array_merge($hreaders, [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]);
        Log::info(config('services.urls.third_party_api_url'));
        $response = Http::withHeaders($hreaders)
        ->post(config('services.urls.third_party_api_url'), $data);

        if ($response->failed()) {
            Log::error('Update users timezones failed', [
                'response' => $response->body(),
                'data' => $data
            ]);
        }

        Log::info('Update users timezones success', [
            'response' => $response->body(),
            'data' => $data
        ]);
    }
}
