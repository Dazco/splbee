<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
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
        return [
            
            'name' => 'required',
            'school' => 'required|exists:schools,id',
            'age' => 'required|numeric|min:7',
            'email' => 'nullable|email|unique:users,email,'.$this->route('user'),
            'role_id' => 'required',
        ];
    }
}
