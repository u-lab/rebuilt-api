<?php

namespace App\Http\Requests\Users;

use App\Models\Storage;
use App\Rules\ExtObj;
use Illuminate\Foundation\Http\FormRequest;

class StoreStorageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', Storage::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'          => ['required', 'string', 'max:50'],
            'description'    => ['string', 'nullable', 'max:50'],
            'long_comment'   => ['string', 'nullable', 'max:100000'],
            'storage'        => [
                'file',
                'max:2048',
                'mimetypes:'.$this->storage_minetypes(),
                new ExtObj($this->file('storage'))
            ],
            'eyecatch_image' => ['file', 'image', 'nullable', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'web_address'    => ['string', 'nullable', 'url' , 'max:255'],
            // 'storage_sub_images'   => ['array', 'nullable'],
            // 'storage_sub_images.*' => ['file', 'image', 'nullable', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ];
    }

    /**
     * storageのminetypesのリスト
     *
     * @return string
     */
    protected function storage_minetypes(): string
    {
        $minetypes = [
            'text/plain', /* obj */
            'application/octet-stream' /* stl, fbx */
            // 'application/x-tgif', /* obj, https://reposcope.com/mimetype/application/x-tgif */
            // 'application/vnd.ms-pki.stl', /* stl */
        ];

        return implode(',', $minetypes);
    }
}
