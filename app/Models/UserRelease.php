<?php

namespace App\Models;

use App\User;
use App\Models\Release;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\UserRelease
 *
 * @property int $user_id
 * @property int $release_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Release $release
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRelease newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRelease newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRelease query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRelease whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRelease whereReleaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRelease whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRelease whereUserId($value)
 * @mixin \Eloquent
 */
class UserRelease extends Model
{
    use LogsActivity;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'release_id'
    ];

        /**
     * Log出力するか
     *
     * @var array
     */
    protected static $logAttributes = [
        'user_id',
        'release_id'
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'user_id'    => 'integer',
        'release_id' => 'integer',
    ];

    /**
     * Userへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * Releaseへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function release(): HasOne
    {
        return $this->hasOne(Release::class, 'id', 'release_id');
    }
}
