<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'user_id'       => ['required', 'string', 'exists:App\User,id'],
            'nick_name'     => ['string', 'nullable', 'max:30'],
            'job_name'      => ['string', 'nullable','max:50'],
            'hobby'         => ['string', 'nullable','max:50'],
            'description'   => ['string', 'nullable','max:50'],
            'icon_image'    => ['file', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048', 'nullable'],
            'icon_image_id' => ['string', 'nullable', 'uuid', 'exists:App\Models\Image,id'],
            'web_address'   => ['string', 'nullable', 'url', 'max:255']
        ];
    }
}
