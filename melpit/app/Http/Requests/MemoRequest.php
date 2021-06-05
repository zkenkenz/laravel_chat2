<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class MemoRequest extends FormRequest
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
            'date' => 'required',
            'title' => 'required|between:0,255',
            'content' => 'required|between:0,32767',
            'serect' => 'required',
            'image' => 'max:1024',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute は必須です。',
            'title.between' => ':attribute は :min 文字から :max 文字の間で入力してください。',
            'content.between' => ':attribute は :min 文字から :max 文字の間で入力してください。',
            'max' => ':attribute は1MB未満にしてください。',
        ];
    }

    public function attributes()
    {
        return [
            'date' => '日付',
            'title' => 'タイトル',
            'content' => '内容',
            'serect' => '投稿の選択',
            'image' => 'アップロードファイル',
        ];
    }

}
