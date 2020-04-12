<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'name' => 'required|string|max:100|regex:/\A[a-z\d]{4,100}+\z/i|unique:users,name,'.$user->id,
            'email' => 'required|max:255|email|unique:users,email,'.$user->id,
        ],[
            'name.regex'     => '半角英数字で入力してください',
        ]);

        return tap($user)->update($request->only('name', 'email'));
    }
}
