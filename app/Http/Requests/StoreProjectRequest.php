<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"=>"required|min:3|max:100",
            "client_name"=>"required|min:3|max:255",
            "summary"=>"required|min:3|max:255",
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'It must have a name',
            'name.max'=>'It must be less than 100 chars',
            'name.min'=>'It must be more than 3 chars',
        ];
    }
}
