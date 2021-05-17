<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * 
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
            'Msg' => 'required|between:0,32767',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute は必須です。',
            'Msg.between' => ':attribute は :min 文字から :max 文字の間で入力してください。',
        ];
    }

    public function attributes()
    {
        return [
            'Msg' => 'メッセージ',
        ];
    }


}
