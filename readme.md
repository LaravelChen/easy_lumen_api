## 基于Lumen的Api框架

> 本Api框架基于Lumen，根据现有的所熟悉的业务来更改了部分代码结构，并且增加了部分中间件，目的是提交post的数据的时候写法的便利性.

### POST提交方式的案例
#### 1.数据使用此形式填充
![image](https://github.com/LaravelChen/easy_lumen_api/raw/master/public/Images/a.png)
#### 2.添加登录的token(此token值请调用登录接口获得)
![image](https://github.com/LaravelChen/easy_lumen_api/raw/master/public/Images/b.png)
#### 3.返回的数据 
![image](https://github.com/LaravelChen/easy_lumen_api/raw/master/public/Images/c.png)

### 路由的写法
在routes文件夹下面创建自定义的文件夹，每创建一个路由文件请在```base.php```引入该文件.具体如下:
```$xslt
//base.php
require  'User/user.php';
```
**同时封装了一些类和trait，请自行看本人写的例子**
```$xslt
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
```
**此方法在UserController.php文件夹下面，所有的业务逻辑写在Controller里面，其中的后台数据逻辑我们利用契约来解耦，具体请看Logic目录下面的代码.**