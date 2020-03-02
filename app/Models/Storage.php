<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Storage
 *
 * @property int $id
 * @property string $storage_id
 * @property int $user_id
 * @property string $title 作品名
 * @property string|null $description 一言コメント
 * @property string|null $long_comment 長文コメント
 * @property string|null $storage_url ストレージURL
 * @property string $eyecatch_imgae_url アイキャッチ画像URL
 * @property string $web_address WEB Address
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Storage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereEyecatchImgaeUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereLongComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereStorageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereWebAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Storage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Storage withoutTrashed()
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
    protected $fillable = [
        'storage_id',
        'user_id',
        'title',
        'description',
        'long_comment',
        'storage_url',
        'eyecatch_image_id',
        'web_address'
    ];

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
        'eyecatch_image_id'  => 'string',
        'web_address'        => 'string'
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * 日付へキャストする属性
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
