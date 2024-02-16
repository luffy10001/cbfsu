<?php

namespace App\Http\Middleware;
use App\Models\User;
use Carbon\Carbon;
use Closure;

class TokenMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');
        $token = str_replace('Bearer','',$token);
        $token = trim($token);

        $tokenArray = json_decode(mws_encrypt('D',$token),true);

        if(!is_array($tokenArray) || !$tokenArray || empty($token)) {
            return response()->json([
                'success'   =>  false,
                'message' => 'Invalid token',
                'data' => $tokenArray
            ], 401);
        }
        if ($tokenArray['expire_at'] < Carbon::now()->format('Y-m-d H:i:s')){
            $data = array();
            $data['expire_at'] = $tokenArray['expire_at'];
            $data['current'] = Carbon::now()->format('Y-m-d H:i:s');
            return response()->json([
                'success'   =>  false,
                'message' => 'Token Expire',
                'data' => $data
            ], 401);
        }
        $user = User::where('api_token', $token)->first();
        if ($user){
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
        } else{
            return response()->json([
                'success'   =>  false,
                'message' => 'Invalid token..',
                'data' => $tokenArray
            ], 401);
        }

        return $next($request);
    }
}