<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SnsAccount
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $sns_id
 * @property string $sns_name SNSサービス名
 * @property string|null $sns_top_url SNSのURL
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SnsAccount onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount whereSnsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount whereSnsName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SnsAccount whereSnsTopUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SnsAccount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SnsAccount withoutTrashed()
 */
class SnsAccount extends Model
{
    use SoftDeletes;

    /**
     * テーブルの主キー
     *
     * @var string
     */
    protected $primaryKey = 'sns_id';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = ['sns_name', 'sns_top_url'];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'sns_id'      => 'integer',
        'sns_name'    => 'string',
        'sns_top_url' => 'string'
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
