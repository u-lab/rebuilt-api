<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserProfile
 *
 * @property int $user_id
 * @property string $nick_name あだ名
 * @property string $job_name 肩書き
 * @property string $hobby 趣味
 * @property string $description 一言コメント
 * @property string $icon_image_id ユーザーアイコンID
 * @property string $web_address ユーザーサイト
 * @property string|null $background_image_id 背景画像
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @property-read \App\Models\Image $icon_image
 * @property-read \App\Models\Image $background_image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereBackgroundImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereHobby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereIconImageId($value)
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
    protected $fillable = [
        'user_id',
        'nick_name',
        'job_name',
        'hobby',
        'description',
        'icon_image_id',
        'background_image_id',
        'web_address'
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'user_id'             => 'integer',
        'nick_name'           => 'string',
        'job_name'            => 'string',
        'hobby'               => 'string',
        'description'         => 'string',
        'icon_image_id'       => 'string',
        'background_image_id' => 'string',
        'web_address'         => 'string'
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
    public function setDescriptionAttribute(string $value)
    {
        $this->attributes['description'] = mb_convert_kana($value, 'asK');
    }

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
    public function setNickNameAttribute(string $value)
    {
        $this->attributes['nick_name'] = mb_convert_kana($value, 'asK');
    }

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
    public function setHobbyAttribute(string $value)
    {
        $this->attributes['hobby'] = mb_convert_kana($value, 'asK');
    }

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
    public function setJobNameAttribute(string $value)
    {
        $this->attributes['job_name'] = mb_convert_kana($value, 'asK');
    }

    /**
     * Userモデルへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Imageへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function icon_image(): HasOne
    {
        return $this->hasOne(Image::class, 'id', 'icon_image_id');
    }

    /**
     * Imageへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function background_image(): HasOne
    {
        return $this->hasOne(Image::class, 'id', 'background_image_id');
    }
}
