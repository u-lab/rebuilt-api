<?php

namespace App\Http\Requests;

use App\Rules\ClientUrl;
use Illuminate\Foundation\Http\FormRequest;

class BreadcrumbsRequest extends FormRequest
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
            'path' => ['string', 'max:255'],
            'url'  => ['string', 'url', new ClientUrl]
        ];
    }
}
