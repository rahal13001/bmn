<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseAuth;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login extends BaseAuth
{
    public function authenticate(): ?LoginResponse
    {
        try {
            $data = $this->form->getState();

            // 1. Call the External API
            $response = Http::post('https://summary.timurbersinar.com/api/login', [
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            // 2. Handle API Failure
            if (!$response->successful() || !$response->json('success')) {
                throw ValidationException::withMessages([
                    'data.email' => 'Invalid credentials or API error.',
                ]);
            }

            $apiData = $response->json('data');
            $apiUser = $apiData['user'];

            // 3. Sync User to Local Database
            $user = User::updateOrCreate(
                ['email' => $apiUser['email']], // Find by email
                [
                    'name' => $apiUser['name'],
                    'email_verified_at' => $apiUser['email_verified_at'] ? \Carbon\Carbon::parse($apiUser['email_verified_at']) : null,
                    'nip' => $apiUser['nip'],
                    'jabatan' => $apiUser['jabatan'],
                    'avatar_url' => $apiUser['avatar_url'],
                    'status' => $apiUser['status'],
                    'sso_user_id' => $apiUser['id'],
                    'sso_token' => $apiData['access_token'],
                ]
            );

            // 4. Log the user in
            Auth::login($user, $data['remember'] ?? false);

            session()->regenerate();

            return app(LoginResponse::class);

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'data.email' => 'An error occurred during authentication: ' . $e->getMessage(),
            ]);
        }
    }
}
