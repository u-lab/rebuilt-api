<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\UserCareer
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $date 日付
 * @property string $name 名前
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCareer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserCareer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCareer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCareer withoutTrashed()
 * @mixin \Eloquent
 */
class UserCareer extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'date',
        'name'
    ];

    /**
     * Log出力するか
     *
     * @var array
     */
    protected static $logAttributes = [
        'id',
        'user_id',
        'date',
        'name'
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'user_id' => 'integer',
        'date'    => 'date',
        'name'    => 'string',
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Userへのリレーションシップ
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
