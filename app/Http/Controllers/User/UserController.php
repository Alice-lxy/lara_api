<?php
    namespace App\Http\Controllers\User;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redis;


    class UserController
    {
        public $redis_h_u_key = 'user:h:u';
        /*
         * 用户登录
         * */
        public function login(Request $request){
            $name = $request->input('u');
            $pwd = $request->input('p');
            if(1){
                //TODO 成功
                $uid = 6;
                $str = time() . $uid . mt_rand(1111,9999);
                $token = substr(md5($str),10,20);
                echo $token;
                //保存token至redis
                $key = $this->redis_h_u_key . $uid;
                Redis::hSet($key,'token',$token);
                Redis::expire($key,3600*24*7);
            }else{
                //todo 失败
            }
        }
        /*
         * 个人中心*/
        public function center(){
            //客户端通过header将数据传过来 ，接受
            //echo '<pre>';print_r($_SERVER);echo '</pre>';
            if(empty($_SERVER['HTTP_TOKEN'])){
                $response = [
                    'errno' =>  5000,
                    'msg'   => '致命错误'
                ];
            }else{
                $response = [
                    'errno' => 0,
                    'msg'   =>  'ok',
                    'data'  =>  [
                        'user'  => 'aaa',
                        'age'   =>  111
                    ],
                ];
            }
            return $response;
        }
    }
