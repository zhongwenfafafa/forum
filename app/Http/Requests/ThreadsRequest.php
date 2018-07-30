<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThreadsRequest extends FormRequest
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
            'title' => 'required|spamfree',
            'body' =>'required|spamfree',
            'channel_id' => 'required|exists:channels,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '主题标题不能为空',
            'title.spamfree' => '主题标题含有不合法内容',
            'body.required' => '主题内容不能为空',
            'body.spamfree' => '主题内容含有不合法内容',
            'channel_id.required' => '主题分类不能为空',
            'channel_id.exists' => '没有找到该分类',
        ];
    }
}
