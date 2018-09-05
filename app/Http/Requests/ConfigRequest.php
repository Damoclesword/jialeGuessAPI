<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
            "title" => "required|max:15",
            "header_image" => "nullable|url",
            "started_at" => "required|date_format:Y-m-d H:i:s",
            "ended_at" => "required|date_format:Y-m-d H:i:s|after:started_at"
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "活动标题必填",
            "title.max" => "活动标题不得超过15字",
            "header_image.url" => "宣传图片必须是有效的地址格式",
            "started_at.required" => "活动开始时间必填",
            "ended_at.required" => "活动结束时间必填",
            "ended_at.after" => "活动结束时间必须晚于开始时间"
        ];
    }
}
