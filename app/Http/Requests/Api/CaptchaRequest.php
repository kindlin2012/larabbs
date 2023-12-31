<?php

namespace App\Http\Requests\Api;
//取消模板生成的默认继承,则生成同文件夹下的类
// use Illuminate\Foundation\Http\FormRequest;

class CaptchaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return true;
        return [
            'phone' => [
                // 'required',
                // 'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                // 'unique:users'
                'phone' => 'required|phone:CN,mobile|unique:users',
            ]
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'phone' => 'required|phone:CN,mobile|unique:users',
        ];
    }
}
