<?php

namespace App\Models;

use App\User;
use App\Models\StorageFile;
use App\Models\StorageSubImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Storage
 *
 * @property int $id
 * @property string $storage_id
 * @property int $user_id
 * @property int $release_id
 * @property string $title 作品名
 * @property string|null $description 一言コメント
 * @property string|null $long_comment 長文コメント
 * @property string|null $storage_url ストレージURL
 * @property string|null $eyecatch_image_id アイキャッチ画像ID
 * @property string $web_address WEB Address
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @property-read \App\Models\Image $eyecatch_image
 * @property-read \App\Models\Release $release
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StorageFile[] $storage_file
 * @property-read int|null $storage_file_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StorageSubImage[] $storage_sub_image
 * @property-read int|null $storage_sub_image_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Storage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereReleaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereEyecatchImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereLongComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereStorageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Storage whereWebAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Storage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Storage withoutTrashed()
 * @mixin \Eloquent
 */
class Storage extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'storage_id',
        'user_id',
        'release_id',
        'title',
        'description',
        'long_comment',
        'storage_url',
        'eyecatch_image_id',
        'web_address'
    ];

    /**
     * Log出力するか
     *
     * @var array
     */
    protected static $logAttributes = [
        'id',
        'storage_id',
        'user_id',
        'release_id',
        'title',
        'description',
        'long_comment',
        'storage_url',
        'eyecatch_image_id',
        'web_address'
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'storage_id'        => 'string',
        'user_id'           => 'integer',
        'release_id'        => 'integer',
        'title'             => 'string',
        'description'       => 'string',
        'long_comment'      => 'string',
        'storage_url'       => 'string',
        'eyecatch_image_id' => 'string',
        'web_address'       => 'string'
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * titleを修正。
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
    public function setTitleAttribute(string $value)
    {
        $this->attributes['title'] = mb_convert_kana($value, 'asK');
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
    public function setDescriptionAttribute(string $value)
    {
        $this->attributes['description'] = mb_convert_kana($value, 'asK');
    }

    /**
     * long_commentを修正。
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
     * Userへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * eyecatchのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eyecatch_image(): HasOne
    {
        return $this->hasOne(Image::class, 'id', 'eyecatch_image_id');
    }

    /**
     * Releaseのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function release(): HasOne
    {
        return $this->hasOne(Release::class, 'id', 'release_id');
    }

    /**
     * StorageSubImageへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storage_sub_image(): HasMany
    {
        return $this->hasMany(StorageSubImage::class, 'storage_id', 'id');
    }

    /**
     * StorageFileへのリレーションシップ
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storage_file(): HasMany
    {
        return $this->hasMany(StorageFile::class, 'storage_id', 'id');
    }
}
