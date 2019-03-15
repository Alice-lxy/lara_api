<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public $redis_h_u_key = 'user:h:u';
    public function handle($request, Closure $next)
    {
        //print_r($_SERVER);die;
        if(empty($_SERVER['HTTP_TOKEN'])){
            $response = [
                'errno' =>  5000,
                'msg'   => '致命错误'
            ];
            die(json_encode($response));
        }else{
            ///验证token是否有效，是否伪造，是否过期
            $key = $this->redis_h_u_key . 6;
            $token = Redis::hGet($key,'token');

            $token1 = $_SERVER['HTTP_TOKEN'];
           if($token1!=$token){
               echo '请验证token';die;
           }
            $response = [
                'errno' => 0,
                'msg'   =>  'ok',
                'data'  =>  [
                    'user'  => 'aaa',
                    'age'   =>  111
                ],
            ];
        }
        //echo json_encode($response);die;
        return $next($request);
    }
}