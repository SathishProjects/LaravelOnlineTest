<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CollegeFormRequest extends Request {

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
                    "name" => "required",
                    "university" => "required",
                    "college_official_contact_person_name" => "required|min:3",
                    "email" => "required|email",
                    "phone" => "required|numeric|min:6",
                    "city" => "required"
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
                    "name.required" => "College Name is required!",
                    "university.required" => "University is required!",
                    "email.required"    => "College Official Email is required!",
                    "city.required"    => "Nearest City is required!",
                    "college_official_contact_person_name.required" => "Contact Person is required"
                ];
        }   

}
