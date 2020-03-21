<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\StorageSubImage
 *
 * @property int $id
 * @property string $storage_id
 * @property string $image_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Image $image
 * @property-read \App\Models\Storage $storage
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageSubImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageSubImage newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StorageSubImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageSubImage query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageSubImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageSubImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageSubImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageSubImage whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageSubImage whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageSubImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StorageSubImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StorageSubImage withoutTrashed()
 * @mixin \Eloquent
 */
class StorageSubImage extends Model
{
    use SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'storage_id',
        'image_id'
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'storage_id' => 'string',
        'image_id'   => 'string',
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Storageへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class, 'id', 'storage_id');
    }

    /**
     * Imageへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image(): HasOne
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
