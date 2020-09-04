<?php


namespace App\Http\Controllers;

use App\Model\Cases;
use App\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

//加解密试玩
class EncryptController extends Controller {
    public function encryptIndex(Request $request){
        $user = Users::find(17);
        $secret = Crypt::encrypt("yqx1989254");

        $user->fill([
           'secret'   => $secret
        ])->save();

        echo strlen($secret);
        return successJson(Crypt::decrypt($user->secret));
    }


}