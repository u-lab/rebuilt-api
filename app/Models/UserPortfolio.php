<?php

namespace App\Models;

use App\User;
use App\Models\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserPortfolio
 *
 * @property int $user_id
 * @property int $masterpiece_storage_id 代表作品
 * @property string $long_comment 本文
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @property-read \App\Models\Storage $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereLongComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereMasterpieceStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserPortfolio whereUserId($value)
 * @mixin \Eloquent
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
    protected $fillable = [
        'user_id',
        'masterpiece_storage_id',
        'long_comment'
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'user_id'                => 'integer',
        'masterpiece_storage_id' => 'integer',
        'long_comment'           => 'string'
    ];

    /**
     * descriptionを修正。
     *
     * 「全角」英数字を「半角」
     *
     * 「全角」スペースを「半角」に変換
     *
     * 「半角カタカナ」を「全角カタカナ」に変換
     *
     * @param string $value
     * @return void
     */
    public function setLongCommentAttribute(string $value)
    {
        $this->attributes['long_comment'] = mb_convert_kana($value, 'asK');
    }

    /**
     * Userへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Storageへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function storage(): HasOne
    {
        return $this->hasOne(Storage::class, 'storage_id', 'masterpiece_storage_id');
    }
}
