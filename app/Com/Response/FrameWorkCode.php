<?php

namespace App\Com\Response;

class FrameWorkCode
{
    public function range()
    {
        return [1, 999];
    }

    const SYSTEM_SUCCESS = ['code' => 0, 'message' => 'success', 'flag' => ResponseData::FLAG_SUCCESS];
    const SYSTEM_TOKEN_FAIL = ['code' => 500, 'message' => '创建token失败', 'flag' => ResponseData::FLAG_FAIL];
    const SYSTEM_LOGIN_FAIL = ['code' => 401, 'message' => '登录失败', 'flag' => ResponseData::FLAG_FAIL];
}