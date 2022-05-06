<?php

namespace App\Http\Requests;

use App\Rules\inLanguageSet;
use App\Rules\validId;
use App\Services\SanitizeMobileNumbers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePerson extends FormRequest
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

    protected function prepareForValidation()
    {

        $sanitizedMobile = new SanitizeMobileNumbers($this->mobile);
        $this->merge([
            'user_id' => Auth::id(),
            'mobile' => $sanitizedMobile->getNumber()
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:128',
            'surname' => 'required|max:128',
            'email' => 'required|email|max:128',
            'mobile' => 'required|max:12|min:10',
            'sa_id' => ['required', 'digits:13', new validId()],
            'dob' => 'required|date:Y-m-d',
            'language_id' => ['required', new inLanguageSet()],
            'interests' => 'nullable|max:200'
        ];
    }
}
