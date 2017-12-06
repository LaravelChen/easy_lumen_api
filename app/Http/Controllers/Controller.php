<?php

namespace App\Http\Controllers;

use App\Com\Traits\ValidatorTrait;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ValidatorTrait;
}
