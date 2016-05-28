<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;

class EditProfileRequest extends Request
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
        switch (Auth::user()->role) {
            case 'student':
                return [
                    'email' => 'Email',
                    'college_id' => 'Integer|Min:1',
                    'first_name' => 'String|Min:2',
                    'last_name' => 'String|Min:2',
                    'college' => 'String|Min:2',
                ];
                break;

            case 'owner':
                return [];
                break;
        }
    }
}
