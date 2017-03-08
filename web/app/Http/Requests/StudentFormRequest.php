<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentFormRequest extends Request {

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
			"first_name" => "required",
			// "date_of_birth" => "required",
			"email" => "required|email",
			"mobile" => "required|numeric|min:6"
		];
	}
        
	/**
	* Override the default error messages
	*
	* @return array
	*/
	public function messages() 
	{
		return [
			"first_name.required" => "First Name is required!",
			// "date_of_birth.required" => "Birthdate is required!",
			"email.required"    => "Email is required!",
			"mobile.required"    => "Mobile Number is required!"
		];
	}   
}
