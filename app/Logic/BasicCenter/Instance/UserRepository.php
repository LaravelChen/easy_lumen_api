<?php
namespace App\Logic\BasicCenter\Instance;
use App\Base\BaseCenter\User;
use App\Com\Code\Base\UserCenterCode;
use App\Com\Response\ResponseData;
use App\Logic\BasicCenter\Contract\UserContract;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserContract
{
    /**
     * 查询指定用户
     * @param $params
     * @return array|static
     */
    public function find($params)
    {
        $user=User::find($params);
        if (!$user){
            Log::warning('App\Logic\BasicCenter\Instance\UserRepository\find', ['获取用户失败',$user]);
            return ResponseData::set(UserCenterCode::USER_NOT_FOUND,$user);
        }
        return ResponseData::success($user);
    }
}