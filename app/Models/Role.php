<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $role_name 権限名
 * @property int $role_level 権限レベル
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereRoleLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role withoutTrashed()
 * @mixin \Eloquent
 */
class Role extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = ['role_name', 'role_level'];

    /**
     * Log出力するか
     *
     * @var array
     */
    protected static $logAttributes = ['id', 'role_name', 'role_level'];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'role_name'  => 'string',
        'role_level' => 'integer'
    ];

    /**
     * システム管理者かどうか
     *
     * @return boolean
     */
    public function is_system(): bool
    {
        return strcmp($this->role_name, 'system') === 0;
    }

    /**
     * 管理者かどうか
     *
     * @return boolean
     */
    public function is_admin(): bool
    {
        return $this->is_system() || strcmp($this->role_name, 'admin') === 0;
    }

    /**
     * 通常ユーザーかどうか
     *
     * @return boolean
     */
    public function is_normal(): bool
    {
        return strcmp($this->role_name, 'normal') === 0;
    }

    /**
     * 禁止されているユーザーかどうか
     *
     * @return boolean
     */
    public function is_ban(): bool
    {
        return strcmp($this->role_name, 'ban') === 0;
    }
}
