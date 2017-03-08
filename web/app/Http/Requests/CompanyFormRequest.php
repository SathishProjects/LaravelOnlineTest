<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanyFormRequest extends Request {

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
                    "company_type" => "required"
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
                    "name.required" => "Company Name is required!",
                    "university.required" => "University is required!"
                ];
        }   
}
