<?php
namespace App\Com\Response;

use App\Com\Traits\ArrayAccessTrait;
use App\Com\Traits\JsonableTrait;
use App\Com\Traits\JsonSerializableTrait;
use ArrayAccess;
use Illuminate\Support\Arr;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Traits\Macroable;

class ResponseData implements ArrayAccess, Arrayable, Jsonable, JsonSerializable
{
    use ArrayAccessTrait, JsonableTrait, JsonSerializableTrait, Macroable;

    const FLAG_SUCCESS = 'success';
    const FLAG_NOTICE  = 'notice';
    const FLAG_FAIL    = 'fail';

    protected $code;

    protected $message;

    protected $messageArgs;

    protected $response;

    protected $flag;

    protected $token = '';

    protected $processer = [];

    protected $successCode = [0];

    public function __construct(array $message, $response = [], $messageArgs = [])
    {
        $this->code        = $message['code'];
        $this->message     = $message['message'];
        $this->messageArgs = $messageArgs;
        $this->flag        = $message['flag'];
        $this->response    = isset($message['response']) ? $message['response'] : $response;
    }

    public static function create($code, $message, $response, $flag = null)
    {
        $data = [
            'code'     => $code,
            'message'  => $message,
            'flag'     => !empty($flag) ? $flag : ($code == 0 ? self::FLAG_SUCCESS : self::FLAG_NOTICE),
            'response' => $response,
        ];

        $instance = new static($data);

        return $instance;
    }

    public static function set($message, $response = [], $messageArgs = [])
    {
        if ($message instanceof ResponseData) {
            return $message;
        }
        return new static((array)$message, $response, $messageArgs);
    }

    public static function success($response = [])
    {
        if ($response instanceof ResponseData) {
            return $response;
        }

        if ($response instanceof Arrayable) {
            $response = $response->toArray();
        }
        return new static(FrameWorkCode::SYSTEM_SUCCESS, $response);
    }

    /**
     * 获取元数据
     * @return [type] [description]
     */
    public function getRawResponse($field = null, $default = null)
    {
        if (is_string($field)) {
            return Arr::get($this->response, $field, $default);
        } else if (is_array($field)) {
            return Arr::only($this->response, $field);
        }

        return $this->response;
    }

    /**
     * 获取加工后的数据
     * @return [type] [description]
     */
    public function getResponse()
    {
        $data = $this->getRawResponse();

        if (count($this->processer) > 0) {
            foreach ($this->processer as $processer) {
                $data = is_callable($processer) ? $processer($data) : $processer->handler($data);
            }
        }

        return $data;
    }

    public function getMessage()
    {
        return $this->_formatMessage();
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * 添加处理者
     * @param  [type] $processer [description]
     * @return [type]            [description]
     */
    public function processer($processer)
    {
        if (! is_array($processer)) {
            $processer = [$processer];
        }

        $this->processer = array_merge($this->processer, $processer);

        return $this;
    }


    /**
     * 是否成功
     * @return boolean [description]
     */
    public function isSuccess($code = [])
    {
        $code = array_merge($this->successCode, $code);
        return in_array($this->code, $code) ? true : false;
    }

    /**
     * 格式化message
     * @return [type] [description]
     */
    protected function _formatMessage()
    {
        if (empty(count($this->messageArgs))) {
            return $this->message;
        }

        $message = $this->message;

        foreach ($this->messageArgs as $key => $value) {
            $value = is_array($value) ? implode(', ', $value) : $value;
            $message = str_replace('#{'.$key.'}', $value, $message);
        }

        return $message;
    }


    public function toArray()
    {
        $data = [
            'code'     => $this->code,
            'message'  => $this->_formatMessage(),
            'response' => $this->getResponse(),
            'flag'     => $this->flag,
        ];

        if (!empty($this->token)) {
            $data['token'] = $this->token;
        }

        return $data;
    }

    public function __toString()
    {
        return $this->toJson();
    }

}