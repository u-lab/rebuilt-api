<?php

namespace App\Models;

use App\Models\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\UserPortfolio
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property int $masterpiece_storage_id 代表作品
 * @property string $long_comment 本文
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereLongComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereMasterpieceStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereUserId($value)
 */
class UserPortfolio extends Model
{
    /**
     * テーブルの主キー
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = ['user_id', 'masterpiece_storage_id', 'long_text'];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'user_id'                => 'integer',
        'masterpiece_storage_id' => 'integer',
        'long_text'              => 'string'
    ];

    /**
     * @return HasOne
     */
    public function storage(): HasOne
    {
        return $this->hasOne(Storage::class, 'storage_id', 'masterpiece_storage_id');
    }
}
