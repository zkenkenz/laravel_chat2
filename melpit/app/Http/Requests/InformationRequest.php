<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformationRequest extends FormRequest
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
            'nickName' => 'required|between:0,10',
            'inlineRadioOptions' => 'required',
            'introduction' => 'required|between:0,255',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute は必須です。',
            'nickName.between' => ':attribute は :min 文字から :max 文字の間で入力してください。',
            'introduction.between' => ':attribute は :min 文字から :max 文字の間で入力してください。',
        ];
    }

    public function attributes()
    {
        return [
            'nickName' => 'ニックネーム',
            'inlineRadioOptions' => '性別',
            'introduction' => '自己紹介文',
        ];
    }
}
