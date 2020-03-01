<?php

namespace App\Models;

use Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'url',
        'url_160',
        'url_320',
        'url_640',
        'url_1024',
        'url_1280',
        'url_1920',
        'url_2580'
    ];

    /**
     * IDが自動増分されるか
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * 自動増分IDの「タイプ」
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // newした時に自動的にuuidを設定する。
        $this->attributes['uuid'] = Str::uuid();
    }
}
