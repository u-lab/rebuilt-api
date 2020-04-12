<?php

namespace App\Models;

use Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Image
 *
 * @property string $id image ID
 * @property string $title 画像名
 * @property string $url オリジナル画像
 * @property string|null $url_80 width = 80
 * @property string|null $url_160 width = 160
 * @property string|null $url_320 width = 320
 * @property string|null $url_640 width = 640
 * @property string|null $url_1024 width = 1024
 * @property string|null $url_1280 width = 1280
 * @property string|null $url_1920 width = 1920
 * @property string|null $url_2580 width = 2580
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUrl1024($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUrl1280($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUrl160($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUrl1920($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUrl2580($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUrl320($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUrl640($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUrl80($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image withoutTrashed()
 * @mixin \Eloquent
*/
class Image extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'url',
        'url_80',
        'url_160',
        'url_320',
        'url_640',
        'url_1024',
        'url_1280',
        'url_1920',
        'url_2580'
    ];

        /**
     * Log出力するか
     *
     * @var array
     */
    protected static $logAttributes = [
        'id',
        'title',
        'url',
        'url_80',
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

    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);

    //     // newした時に自動的にuuidを設定する。
    //     $this->attributes['id'] = Str::uuid();
    // }
}
