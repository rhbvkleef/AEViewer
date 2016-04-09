<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Config;

use App\User;
use App\Helpers\APITokenGenerator as TokenGenerator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller {
    public function getSettings() {
        return view('auth.settings')
        ->with('user', Auth::user());
    }

    public function postResetToken() {
        $user = Auth::user();
        $generator = new TokenGenerator();

        $user->api_token = $generator->generate(32);
        $user->save();

        return redirect()->back();
    }
}
