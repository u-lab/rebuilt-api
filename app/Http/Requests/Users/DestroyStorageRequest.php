<?php

namespace App\Http\Requests\Users;

use App\Rules\StorageID;
use Illuminate\Foundation\Http\FormRequest;

class DestroyStorageRequest extends FormRequest
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
     * バリーデーションのためにデータを準備
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'storage_id' => $this->storage_id /* URLパラメータ */
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'storage_id' => ['bail', 'string', new StorageID, 'exists:App\Models\Storage,storage_id']
        ];
    }
}
