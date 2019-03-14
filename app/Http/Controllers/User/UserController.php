<?php
    namespace App\Http\Controllers\User;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redis;


    class UserController
    {
        /*
         * 用户登录
         * */
        public function login(Request $request){
            $name = $request->input('u');
            $pwd = $request->input('p');
            $uid = $request->input('uid');
//            echo $name;echo '<br/>';
//            echo $pwd;
            $str = time() .$uid.mt_rand(1111,9999);

            $token = substr(md5($str),10,20);
            Redis::hGet();
        }
    }