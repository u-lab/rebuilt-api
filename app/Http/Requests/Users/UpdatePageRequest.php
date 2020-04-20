<?php

namespace App\Http\Requests\Users;

use App\User;
use App\Rules\StorageID;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'user_id'                => ['required', 'integer', 'exists:App\User,id'],
            'masterpiece_storage_id' => ['string', new StorageID, 'exists:App\Models\Storage,storage_id'],
            // 'long_comment'           => ['string', 'max:100000', 'nullable']
        ];
    }
}
