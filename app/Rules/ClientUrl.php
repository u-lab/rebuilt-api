<?php

namespace App\Rules;

use App\Facades\Helper;
use Illuminate\Contracts\Validation\Rule;

class ClientUrl implements Rule
{
    /**
     * 許可するURL
     *
     * @var string[]
     */
    protected $_allow_urls;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_allow_urls = [
            'http://localhost:3000'
        ];
        $client = Helper::client_route('/');
        if (strcmp($this->_allow_urls[0], $client) !== 0) {
            $this->_allow_urls[] = $client;
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
        if (is_null($value)) {
            return true;
        }

        return $this->check_url($value);
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

    /**
     * 値が許可するURLに一致するか確認する
     *
     * @param string $value
     * @return boolean
     */
    protected function check_url(string $value): bool
    {
        $allow_urls = $this->_allow_urls;
        foreach ($allow_urls as $allow_url) {
            if (strpos($value, $allow_url) !== false) {
                return true;
            }
        }

        return false;
    }
}
