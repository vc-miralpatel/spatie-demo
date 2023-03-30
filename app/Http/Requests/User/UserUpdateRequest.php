<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
       // dd($request->null);
        return [
            // 'password' => 'required|same:confirm-password',
            'name' => ['required', 'string', 'max:255'],
           // 'email' => "unique:users,email,$this->id,id",
           //bellow working
           'email' => ['required', 'string', 'email', 'max:255',
                 Rule::unique('users')->ignore($this->user),
             ],
           // 'password' => ['required', 'string', 'min:3', 'confirmed'],
            'roles' => ['required']
        ];
        
        // return [
        //     'email' => ['required', 'string', 'email', 'max:255',
        //         Rule::unique('users')->ignore($this->user),
        //     ],
        // ];
    }

    public function messages()
    {
        return[
            'email.required' => 'Please enter valid email (e.g. abc@xyz.com).',
        ];
    }
}
