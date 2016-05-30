<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;
use Validator;

class EditProfileRequest extends Request {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return TRUE;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    switch (Auth::user()->role) {
      case 'student':
        return [
          'email' => 'email',
          'college_id' => 'integer|min:1',
          'first_name' => 'string|min:2',
          'last_name' => 'string|min:2',
          'college' => 'string|min:2',
        ];
        break;
    }
  }

  public function messages() {
    return [
      'first_name.string' => 'Controleer alstublieft uw voornaam.',
      'last_name.string' => 'Controleer alstublieft uw achternaam.',
      'college' => 'Selecteer een school.',
    ];
  }

}
