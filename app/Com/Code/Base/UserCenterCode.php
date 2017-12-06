<?php

namespace App\Com\Code\Base;

use App\Com\Code\AbstractCode;
use App\Com\Response\ResponseData;

class UserCenterCode extends AbstractCode
{
    public function range()
    {
        // TODO: Implement range() method.
        return [1114 - 1150];
    }

    //添加该中心的code信息
    const USER_NOT_FOUND = ['code' => 1115, 'message' => '查询不到该用户', 'flag' => ResponseData::FLAG_NOTICE];
}