<?php

namespace App\Http\Controllers\UserCenter;

use App\Com\Code\Base\UserCenterCode;
use App\Com\Response\ResponseData;
use App\Http\Controllers\Controller;
use App\Logic\BasicCenter\Contract\UserContract;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class APIController extends Controller
{
    /**
     * 根据Model获取用户信息
     * @return string
     */
    public function get_user_info(Request $request,UserContract $userLogic)
    {
        $rule=[
            'id'=>'required',
        ];
        $valid=$this->com_validate($request->all(),$rule);
        if (!$valid['is_valid']){
            Log::warning('App\Http\Controllers\APIController\UserCenter\get_user_info', ['获取信息-参数错误']);
            return ResponseData::set(UserCenterCode::PARAMETER_ERROR,$valid['errors']);
        }
        $result=$userLogic->find($request->get('id'));
        return ResponseData::set($result);
    }

    /*
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_info(Request $request)
    {
        $rule = [
            'name' => 'required',
            'info.sex' => 'required',
            'info.age' => 'required',
        ];
        $valid = $this->com_validate($request->all(), $rule);
        if ( !$valid['is_valid']) {
            Log::warning('App\Http\Controllers\APIController\UserCenter\get_info', ['获取信息-参数错误']);
            return \response(['code' => 1101, 'message' => '参数错误', 'flag' => 'notice', 'response' => $valid['errors']]);
        }
        $args = [
            'name' => $request->get('name'),
            'sex' => Arr::get($request->get('info'), 'sex', ''),
            'age' => Arr::get($request->get('info'), 'age', 0),
        ];
        return ResponseData::success($args);
    }
}
