<?php

namespace App\Http\Requests\Users;

use App\User;
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
        return $this->user()->can('update', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'       => ['required', 'integer', 'exists:App\User,id'],
            'nick_name'     => ['string', 'nullable', 'max:30'],
            'job_name'      => ['string', 'nullable','max:50'],
            'kana'          => ['string', 'nullable','max:50'],
            'hobby'         => ['string', 'nullable','max:50'],
            'description'   => ['string', 'nullable','max:50'],
            'icon_image'    => ['file', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048', 'nullable'],
            'background_image'    => ['file', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048', 'nullable'],
            'web_address'   => ['string', 'nullable', 'url', 'max:255'],
            'user_career'   => ['array', 'nullable'],
            'user_career.*.id' => ['integer', 'nullable'],
            'user_career.*.date' => ['date'],
            'user_career.*.name' => ['string', 'max:50'],
            'user_career.*.type' => ['string', 'max:50', 'nullable'],
            'user_career_did' => ['array', 'nullable'],
            'user_career_did.*' => ['integer']
        ];
    }
}
