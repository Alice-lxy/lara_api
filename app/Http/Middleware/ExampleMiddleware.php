<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class ExampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request_uri = $_SERVER['REQUEST_URI'];
        $hash_uri = substr(md5($request_uri),0,10);
        //echo $hash_uri;echo '<br/>';
        $ip = $_SERVER['REMOTE_ADDR'];    //获取客户端IP
        //echo $ip;echo '<br/>';

        $redis_key = 'str:' . $hash_uri .':'. $ip;
       // echo $redis_key;echo '<br/>';

        $keys_num = Redis::incr($redis_key);    //incr 自增1
       // echo $keys_num;echo '<br/>';
        Redis::expire($redis_key,60);

        if($keys_num>6){
            $response = [
                'errno'    =>  5000,
                'msg'      =>  '您已错失良机,',
            ];
            Redis::expire($redis_key,600);//十分钟后方可执行
            die(json_encode($response));
        }
        return $next($request);
    }
}
