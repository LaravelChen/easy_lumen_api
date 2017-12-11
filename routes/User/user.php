<?php
/*
 * 用户auth接口
 */
$api->version('v1', function ($api) {
    $api->post('/auth/login', [
        'as' => 'api.auth.login',
        'uses' => 'App\Http\Controllers\Auth\AuthController@postLogin',
    ]);

    //登陆后
    $api->group(['middleware' => 'jwt.auth',], function ($api) {
        $api->post('/get_info','App\Http\Controllers\UserCenter\APIController@get_info'); #获取信息
        $api->post('/get_user_info','App\Http\Controllers\UserCenter\APIController@get_user_info');#获取用户信息

        /*
         * JWT自带函数
         */
        $api->post('/auth/user', [
            'uses' => 'App\Http\Controllers\Auth\AuthController@getUser',
            'as' => 'api.auth.user',
        ]);
        $api->patch('/auth/refresh', [
            'uses' => 'App\Http\Controllers\Auth\AuthController@patchRefresh',
            'as' => 'api.auth.refresh',
        ]);
        $api->delete('/auth/invalidate', [
            'uses' => 'App\Http\Controllers\Auth\AuthController@deleteInvalidate',
            'as' => 'api.auth.invalidate',
        ]);
    });
});
