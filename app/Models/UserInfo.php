<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserInfo
 *
 * @property int $user_id
 * @property string $last_name 性
 * @property string $first_name 名
 * @property string|null $last_kana セイ
 * @property string|null $first_kana メイ
 * @property string $school_name 学校名
 * @property \Illuminate\Support\Carbon $birthday 誕生日
 * @property string $prefecture 都道府県
 * @property string $city 市区町村
 * @property string $street その他、アパート等
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereFirstKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereLastKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo wherePrefecture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereSchoolName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereUserId($value)
 * @mixin \Eloquent
 */
class UserInfo extends Model
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
        'first_name',
        'last_name',
        'first_kana',
        'last_kana',
        'school_name',
        'birthday',
        'prefecture',
        'city',
        'street'
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'user_id'     => 'integer',
        'first_name'  => 'string',
        'last_name'   => 'string',
        'first_kana'  => 'string',
        'last_kana'   => 'string',
        'school_name' => 'string',
        'birthday'    => 'date',
        'prefecture'  => 'string',
        'city'        => 'string',
        'street'      => 'string'
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['birthday', 'created_at', 'updated_at'];

    /**
     * Userへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
