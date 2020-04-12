<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Release
 *
 * @property int $id
 * @property string $release_name 公開名
 * @property int $release_level 公開レベル
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Release onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereReleaseLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereReleaseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Release whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Release withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Release withoutTrashed()
 * @mixin \Eloquent
 */
class Release extends Model
{
    use LogsActivity ,SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'release_name',
        'release_level',
    ];

    /**
     * Log出力するか
     *
     * @var array
     */
    protected static $logAttributes = ['id', 'release_name', 'release_level'];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'release_name'  => 'string',
        'release_level' => 'integer',
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
