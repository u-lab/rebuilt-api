<?php

namespace App\Http\Requests\Users;

use Log;
use App\Rules\ExtObj;
use App\Rules\StorageID;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Storage\StorageRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateStorageRequest extends FormRequest
{
    protected $_storageRepository;

    public function __construct(StorageRepositoryInterface $storageRepository)
    {
        $this->_storageRepository = $storageRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            $storage = $this->_storageRepository
                            ->get_storage_no_user_id($this->storage_id);
            return $storage && $this->user()->can('update', $storage);
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'           => ['required', 'integer', 'exists:App\User,id'],
            'storage_id'        => [
                'required',
                'string',
                new StorageID,
                // 'exists:App\Models\Storage,storage_id'
            ],
            'title'             => ['required', 'string', 'max:50'],
            'description'       => ['string', 'max:50', 'nullable'],
            'long_comment'      => ['string', 'max:100000', 'nullable'],
            'storage'           => [
                'file',
                'max:2048',
                'mimetypes:'.$this->storage_minetypes(),
                new ExtObj($this->file('storage'))
            ],
            'eyecatch_image'     => ['file', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048', 'nullable'],
            'eyecatch_image_id'  => ['integer', 'nullable'],
            'web_address'        => ['string', 'url', 'max:255', 'nullable'],
            'release_id'         => ['required', 'integer', 'min:1', 'max:3']
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
