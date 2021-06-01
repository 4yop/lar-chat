<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserFriend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{

    public function register(UserRequest $request)
    {
        $res = User::insertGetId([
                    'name' => '随机名字',
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
        if (!$res)
        {
            throw new UserException('注册失败');
        }

        return success_json('注册成功');
    }

    public function login (UserRequest $request)
    {

        if ( !$token = Auth::guard('api')->setTTL(1000)->login($request->user) )
        {
            throw new UserException('登录失败');
        }
//
//        $a = Auth::guard('api')->getUser();
        Cache::put("lar-chat:token:$token",$request->user,auth('api')->factory()->getTTL() * 60);

        return success_json('登录成功',[
            'token' => $token,
            'expires_time' => time()+auth('api')->factory()->getTTL() * 60,
        ]);
    }

    public function show(User $user, Request $request)
    {

        $data = [
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'avatar' => $request->user()->avatar,
        ];
        return success_json('ok',$data);
    }

    public function logout()
    {

        auth('api')->logout();
        return success_json('退出登录');
    }

    public function qrcode(Request $request)
    {
        // Create QR code
        $user = $request->user();
        $data =  route("page")."#/pages/businessCard/businessCard?id=".$user->id;
        $qrCode = QrCode::create($data)
                        ->setEncoding(new Encoding('UTF-8'))
                        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                        ->setSize(300)
                        ->setMargin(10)
                        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                        ->setForegroundColor(new Color(0, 0, 0))
                        ->setBackgroundColor(new Color(255, 255, 255));

        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $full_name = "img/code/".md5($user->id).".png";
        touch($full_name);
        $result->saveToFile($full_name);
        return success_json('ok',[
            'qr_code'=> str_replace('https://','http://',url(null,[],null)->secureAsset($full_name)),
        ]);

    }

}
