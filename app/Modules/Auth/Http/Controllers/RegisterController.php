<?php

declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use App\Modules\Auth\Models\User;
use App\Modules\Blog\Http\Controllers\Links\IndexController;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

final class RegisterController
{
    use RegistersUsers, ValidatesRequests;

    protected function validator(array $data): \Illuminate\Validation\Validator
    {
        $passwordRules = ['required', 'string', 'confirmed'];

        if (app()->environment('production')) {
            $passwordRules[] = Password::min(8)->uncompromised();
        }

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $passwordRules,
            'twitter_handle' => [
                'nullable', 'max:15', 'regex:/^[A-Za-z0-9_]+$/',
                Rule::unique('users', 'twitter_handle'),
            ],
        ], [
            'twitter_handle.max' => 'Your Twitter username may not be greater than 15 characters.',
            'twitter_handle.regex' => 'Your Twitter username may only contain letters, numbers and underscores.',
        ]);
    }

    protected function create(array $data): User
    {
        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'twitter_handle' => $data['twitter_handle'],
        ]);

        $user->sendEmailVerificationNotification();

        return $user;
    }

    public function redirectPath(): string
    {
        if (auth()->user()->admin) {
            return '/admin/posts';
        }

        return action(IndexController::class);
    }
}
