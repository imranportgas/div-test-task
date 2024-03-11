<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function validateCreatedUser(array $properties): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($properties, [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::default()
            ], [
                'required' => ':attribute - Должно быть обязательное поле',
                'string' => ':attribute - Должно быть строкой',
                'email' => ':attribute - Должен быть email',
                'unique' => ':attribute - Должен быть уникальным',
                'confirmed' => ':attribute - Не подтверждён'
            ]
        ]);
    }

    public function validateLoginUser(array $properties): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($properties, [
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);
    }

    public function createUser(array $properties)
    {
        $validator = $this->validateCreatedUser($properties);

        if ($validator->fails()) {
            return [
                'Данные заполнены некорректно',
                $validator->errors()->toArray()
            ];
        }

        /** @var User $user */

        $user = User::create($properties);
        $token = $user->createToken($user->name)->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function loginUser(array $properties)
    {
        $result = $this->validateLoginUser($properties);

        if ($result->fails()) {
            return [
                'Данные заполнены не корректно',
                $result->errors()->toArray()
            ];
        }

        if (!Auth::attempt($properties)) {
            return 'Email или пароль неверны';
        }

        /** @var User $user */

        $user = Auth::user();
        $token = $user->createToken($user->name)->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
}
