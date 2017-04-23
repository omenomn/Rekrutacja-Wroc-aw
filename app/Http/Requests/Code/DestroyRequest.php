<?php

namespace App\Http\Requests\Code;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class DestroyRequest extends FormRequest
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
          'remove_codes' => 'required|array',
          'remove_codes.*' => 'required|exists:codes,code',
        ];
    }

    public function response(array $errors)
    {
      return redirect()->back()
        ->with('errorMessage', $errors[0])->withInput();
    }

    protected function formatErrors(Validator $validator)
    {
        return [
            $validator->errors()->first()
        ];
    }
}
