<?php

namespace App\Http\Requests\API\V1\DataExporter\Task;

use App\Rules\ValidDateTimeString;
use Illuminate\Foundation\Http\FormRequest;

class ExportTaskRequest extends FormRequest
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
            'from_date' => ['required', new ValidDateTimeString],
            'to_date' => ['required', new ValidDateTimeString],
        ];
    }

    public function from(): string
    {
        return $this->from_date;
    }

    public function to(): string
    {
        return $this->to_date;
    }
}
