<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updateUser extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user');
        return [
            'name'=>['required','min:3','max:16'],
            'email'=>['required','email',Rule::unique('admin_users', 'email')->ignore($id)],
            'phone'=>['required','min:9','max:11',Rule::unique('admin_users', 'phone')->ignore($id)],
            'password'=>['required','min:8','max:16']
        ];
    }
}
