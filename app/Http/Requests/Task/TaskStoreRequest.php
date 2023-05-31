<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
class TaskStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => [
                Rule::exists('tags', 'name')->where(function ($query) {
                    $query->where('user_id', Auth::id());
                }),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }


}
