<?php

namespace App\Com\Code;


use App\Com\Response\ResponseData;

abstract class AbstractCode
{
    abstract public function range();

    const RESPONSE_SUCCESS = ['code' => 0, 'message' => 'success', 'flag' => ResponseData::FLAG_SUCCESS];

    const PARAMETER_ERROR              = ['code' => 1101, 'message' => '参数错误', 'flag' => ResponseData::FLAG_NOTICE];
    const NOT_FOUND                    = ['code' => 1102, 'message' => '查询不到相关数据', 'flag' => ResponseData::FLAG_NOTICE];
    const SYSTEM_BUSY                  = ['code' => 1103, 'message' => '系统繁忙', 'flag' => ResponseData::FLAG_NOTICE];
    const NO_AUTH                      = ['code' => 1104, 'message' => '无权限访问', 'flag' => ResponseData::FLAG_NOTICE];
    const EXISTS_DATA                  = ['code' => 1105, 'message' => '数据已存在', 'flag' => ResponseData::FLAG_NOTICE];
    const ADD_ERROR                    = ['code' => 1106, 'message' => '新增失败', 'flag' => ResponseData::FLAG_NOTICE];
    const UPDATE_ERROR                 = ['code' => 1107, 'message' => '更新失败', 'flag' => ResponseData::FLAG_NOTICE];
    const NOT_REPEAT                   = ['code' => 1108, 'message' => '请勿频繁操作', 'flag' => ResponseData::FLAG_NOTICE];
    const DELETE_ERROR                 = ['code' => 1109, 'message' => '删除失败', 'flag' => ResponseData::FLAG_NOTICE];
    const SYSTEM_ERROR                 = ['code' => 1110, 'message' => '系统错误', 'flag' => ResponseData::FLAG_NOTICE];
    const NOT_EXISTS_DATA              = ['code' => 1111, 'message' => '数据不存在', 'flag' => ResponseData::FLAG_NOTICE];
    const UPDATE_DATE_EXIST            = ['code' => 1112, 'message' => '更新数据已存在', 'flag' => ResponseData::FLAG_NOTICE];
    const STATUS_EXCEPTION             = ['code' => 1113, 'message' => '状态异常', 'flag' => ResponseData::FLAG_NOTICE];
}
