<?php

namespace App\Http\Requests\API\V1\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes | max:100',
            'body' => 'sometimes | min:5',
            'time_estimated' => 'sometimes',
            'time_spent' => 'sometimes',
        ];
    }

    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function timeEstimated(): string
    {
        return (string)$this->time_estimated;
    }

    public function timeSpent(): string
    {
        return (string)$this->time_spent;
    }
}
