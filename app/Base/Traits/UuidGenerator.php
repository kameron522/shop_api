<?php

namespace App\Base\Traits;


trait UuidGenerator
{
    public static function Uuid($all_of_model)
    {
        function UniqUuid($all_objects)
        {
            $uuid = rand(20000000, 80000000);
            foreach($all_objects as $obj)
            {
                if ($uuid === $obj->uuid)
                    return 0;
            }
            return $uuid;
        }

        while(true)
        {
            $result = UniqUuid($all_of_model);
            if ($result)
                return $result;
        }
    }
}
