<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserProfile
 *
 * @property int $user_id
 * @property string $nick_name あだ名
 * @property string $job_name 肩書き
 * @property string $hobby 趣味
 * @property string $description 一言コメント
 * @property string $icon_image_url ユーザーアイコン
 * @property string $web_address ユーザーサイト
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereHobby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereIconImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereJobName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereNickName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereWebAddress($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model
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
    protected $fillable = ['user_id', 'nick_name', 'job_name', 'hobby', 'description', 'icon_image_url', 'web_address'];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'user_id'        => 'integer',
        'nick_name'      => 'string',
        'job_name'       => 'string',
        'hobby'          => 'string',
        'description'    => 'string',
        'icon_image_url' => 'string',
        'web_address'    => 'string'
    ];
}
