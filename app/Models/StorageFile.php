<?php

namespace App\Models;

use App\Models\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\StorageFile
 *
 * @property int $id
 * @property string $storage_id
 * @property string $url URL
 * @property string $extension 拡張子
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Storage $storage
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StorageFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageFile whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StorageFile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StorageFile withoutTrashed()
 * @mixin \Eloquent
 */
class StorageFile extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'storage_id',
        'url',
        'extension'
    ];

    /**
     * Log出力するか
     *
     * @var array
     */
    protected static $logAttributes = [
        'id',
        'storage_id',
        'url',
        'extension'
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'storage_id' => 'integer',
        'url'        => 'string',
        'extension'  => 'string'
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Undocumented function
     *
     * @return BelongsTo
     */
    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class, 'id', 'storage_id');
    }
}
