<?php
    namespace App\Http\Controllers\User;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redis;


    class UserController
    {
        public $redis_h_u_key = 'user:h:u';
        /** 用户登录 */
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
        /** 个人中心*/
        public function center(){
            echo 'ok';
        }
        /** 防刷*/
       /* public function order(){
//            print_r($_SERVER);echo '<br/>';die;
            $request_uri = $_SERVER['REQUEST_URI'];
            $hash_uri = substr(md5($request_uri),0,10);
            echo $hash_uri;echo '<br/>';
            $ip = $_SERVER['REMOTE_ADDR'];    //获取客户端IP
            echo $ip;echo '<br/>';

            $redis_key = 'str:' . $hash_uri .':'. $ip;
            echo $redis_key;echo '<br/>';

            $keys_num = Redis::incr($redis_key);    //incr 自增1
            echo $keys_num;echo '<br/>';
            Redis::expire($redis_key,60);

            if($keys_num>6){
                 $response = [
                     'errno'    =>  5000,
                     'msg'      =>  '您已错失良机,',
                 ];
                Redis::expire($redis_key,600);//十分钟后方可执行
            }else{
                $response = [
                    'errno' =>  0,
                    'msg'   =>  'ok',
                    'data'  =>  [
                        'name'   =>  'bbb',
                        'age'   =>  111,
                    ],
                ];
            }
            return $response;
        }*/
    }