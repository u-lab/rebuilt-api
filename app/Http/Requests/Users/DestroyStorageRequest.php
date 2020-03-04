<?php

namespace App\Http\Requests\Users;

use App\Rules\StorageID;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Storage\StorageRepositoryInterface;

class DestroyStorageRequest extends FormRequest
{
    /**
     * @var \App\Repositories\Storage\StorageRepositoryInterface
     */
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
        $storage = $this->_storageRepository
                        ->get_storage_no_user_id($this->route('storage_id'));
        return $this->user()->can('destroy', $storage);
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
