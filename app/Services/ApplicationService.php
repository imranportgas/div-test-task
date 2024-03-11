<?php

namespace App\Services;

use App\Models\Application;
use App\Notifications\ApplicationNotification;
use App\Repositories\ApplicationRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApplicationService
{

    protected ApplicationRepository $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        return $this->applicationRepository = $applicationRepository;
    }

    public function validateApplication(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|string|unique:applications,email',
            'message' => 'required|string',
            'comment' => 'nullable|string'
        ], [
            'required' => ':attribute - Обятельное поле',
            'string' => ':attribute - Должно быть строкой',
            'email' => ':attribute - Должен быть email',
            'nullable' => ':attribute - Необязательное поле',
            'unique' => ':attribute - Должен быть уникальным',
        ]);
    }

    public function createApplication(array $data)
    {
        $validator = $this->validateApplication($data);

        if ($validator->fails()) {
            return [
                'message' => 'Данные заполены некорректно',
                'errors' => $validator->errors()->toArray()
            ];
        }

        $result = Application::query()->create($data);
        return $result;
    }

    public function respondToApplication($id, array $data)
    {
        $application = Application::find($id);

        if (!$application) {
            return [ 'message' => 'Заявка не найдена' ];
        }

        $application->update(['status' => Application::STATUS_CONFIRMED, 'comment' => $data['comment']]);
        Mail::to($application->email)->send(new ApplicationNotification($application));
        return $application;
    }
}
