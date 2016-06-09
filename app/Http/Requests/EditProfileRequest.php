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
          'college_id' => 'required|integer|min:1',
          'first_name' => 'required|string|min:2',
          'last_name' => 'required|string|min:2',
          'college_id' => 'required|integer|min:1',
        ];
        break;
      case 'teacher':
        return [
          'college_id' => 'required|integer|min:1',
          'first_name' => 'required|string|min:2',
          'last_name' => 'required|string|min:2',
          'college' => 'required|string|min:2',
          'telephone_number' => 'required|string|min:10|max:10',
        ];
        break;
      case 'college':
        return [
          'name' => 'required|string|min:1',
          'first_name' => 'required|string|min:2',
          'last_name' => 'required|string|min:2',
          'telephone_number' => 'required|string|min:10|max:10',
        ];
        break;
      case 'reviewer':
        return [
          'company_id' => 'required|integer|min:1',
          'first_name' => 'required|string|min:2',
          'last_name' => 'required|string|min:2',
          'telephone_number' => 'required|string|min:10|max:10',
        ];
        break;
      case 'company':
        return [
          'name' => 'required|string|min:1',
          'address' => 'required|string|min:2',
          'zip_code' => 'required|string|max:6|min:6',
          'iso_number' => 'required|integer|min:2',
          'telephone_number' => 'required|string|min:10|max:10',
        ];
      case 'administrator':
        return [
          'first_name' => 'required|string|min:2',
          'last_name' => 'required|string|min:2',
          'telephone_number' => 'required|string|min:10|max:10',
        ];
    }
  }

  public function messages() {
    return [
      'first_name.required.string' => 'Controleer alstublieft uw voornaam.',
      'last_name.required.string' => 'Controleer alstublieft uw achternaam.',
      'college_id.required.string' => 'Selecteer een school.',
    ];
  }

}
