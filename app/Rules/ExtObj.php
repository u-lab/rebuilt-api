<?php

namespace App\Rules;

use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Validation\Rule;

class ExtObj implements Rule
{
    /**
     * 元ファイル
     *
     * @var \Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]|array|null $file
     */
    protected $_file;

    /**
     * 拡張子一覧
     *
     * @var string[]
     */
    protected $_exts;

    /**
     * 確認する拡張子一覧(関数名)
     *
     * @var string[]
     */
    protected $_extfunc;

    /**
     * Create a new rule instance.
     *
     * @param \Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]|array|null $file
     * @param array $exts
     * @return void
     */
    public function __construct($file, array $exts = ['obj', 'fbx'])
    {
        $this->_file = $file;
        $this->_exts = $exts;

        foreach ($exts as $ext) {
            $this->_extfunc[$ext] = 'is_' . $ext;
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // 送信元の拡張子を取得
        $original_ext = strtolower($this->_file->getClientOriginalExtension());
        $original_ext_check = '';

        // 送信元の拡張子と拡張子一覧が一致するか確認
        foreach ($this->_exts as $ext) {
            if (strcmp($original_ext, $ext) === 0) {
                $original_ext_check = $ext;
                break;
            }
        }

        // チェック済みの拡張子があるか確認
        if (isset($original_ext_check)) {
            // func名を取得
            $func = $this->_extfunc[$original_ext_check];
            // is_{$ext}を実行
            return $this->$func($value);
        }

        return false;
    }

    /**
     * objファイルかどうか確認する
     *
     * @param mixed $value
     * @return boolean
     */
    protected function is_obj($value): bool
    {
        try {
            // ファイルの内容を配列で取得
            $contents = explode("\n", File::get($value));

            // ファイル内にobjの文字が出てくるか確認
            for ($i = 0; $i < 2; $i++) {
                if (stripos($contents[$i], 'obj') !== false) {
                    return true;
                }
            }

            return false;
        } catch (FileNotFoundException $e) {
            return false;
        }
    }

    protected function is_fbx(): bool
    {
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
