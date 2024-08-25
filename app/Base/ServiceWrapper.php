<?php

namespace App\Base;

use Closure;
use Illuminate\Support\Facades\DB;
use Throwable;

class ServiceWrapper
{
    public function __invoke(Closure $action, string $msg = "No message")
    {
        DB::beginTransaction();
        try
        {
            list($actionResult, $status_code) = $action();
            if (!$status_code)
                $status_code = 200;
            // $actionResult = $action();
            DB::commit();
        }
        catch(Throwable $th)
        {
            DB::rollBack();
            return response()->json([
                'error' => $th->getMessage()
            ], status: 500);
        }

        return response()->json([
            'message' => $msg,
            'data' => $actionResult
        ], status: $status_code);
    }
}
