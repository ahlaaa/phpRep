<?php
/**
 * Created by PhpStorm.
 * User: SX
 * Date: 2017/12/14
 * Time: 13:04
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Factory as Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Response;
use InfyOm\Generator\Utils\ResponseUtil;
use OAuthException;

class AuthenticateApi extends Authenticate
{

    protected function authenticate(array $guards)
    {
        if ($this->auth->guard('api')->check()) {
            return $this->auth->shouldUse('api');
        }
        throw new UnauthorizedHttpException('', '无权限');
//        return Response::json(ResponseUtil::makeError('验证码失效'), 401);
    }

}