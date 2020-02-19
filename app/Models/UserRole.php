<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\UserRole
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property int $role_id
 * @property-read \App\Models\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereUserId($value)
 */
class UserRole extends Model
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
    protected $fillable = ['user_id', 'role_id'];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'role_id' => 'integer'
    ];

    /**
     * Roleモデルへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
