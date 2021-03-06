<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;

class ReliesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*return Gate::allows('create', new \App\Models\Reply);*/
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
            'body' => 'required|spamfree'
        ];
    }

    public function messages()
    {
        return [
            'body.required' => '回复内容不能为空',
            'body.spamfree' => '含有不合法内容',
        ];
    }
}
