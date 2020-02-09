<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Storage
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Storage extends Model
{
    use SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = ['storage_id', 'user_id', 'title', 'description', 'long_comment', 'storage_url', 'eyecatch_imgae_url', 'web_address'];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'id'                 => 'integer',
        'storage_id'         => 'string',
        'user_id'            => 'integer',
        'title'              => 'string',
        'description'        => 'string',
        'long_comment'       => 'string',
        'storage_url'        => 'string',
        'eyecatch_imgae_url' => 'string',
        'web_address'        => 'string'
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
