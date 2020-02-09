<?php

namespace App\Models;

use App\Models\SnsAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UserSnsAccount
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSnsAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSnsAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSnsAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSnsAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSnsAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSnsAccount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserSnsAccount extends Model
{
    use SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = ['user_id', 'sns_id', 'sns_url'];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'user_id' => 'integer',
        'sns_id'  => 'integer',
        'sns_url' => 'string'
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function sns_account(): HasOne
    {
        return $this->hasOne(SnsAccount::class, 'sns_id', 'sns_id');
    }
}
