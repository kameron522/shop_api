<?php

namespace App\Base\Traits;


trait MsgValidation
{
    public static function HasTxtOrImg()
    {
        if(!request()->text && !request()->image)
            return false;
        return true;
    }
}
