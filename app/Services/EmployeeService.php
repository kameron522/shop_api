<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Base\Traits\UuidGenerator;
use App\Models\User;
use Aws\Api\Service;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{
    use UuidGenerator;

    public function AllEmployees()
    {
        return app(ServiceWrapper::class)(
            function()
            {
                $employees = User::where('is_employee', true)->get();
                return $employees;
            }
        );
    }


    public function CreateEmployee(array $inputs)
    {
        return app(ServiceWrapper::class)(
            function() use($inputs)
            {
                $user = User::create($inputs);
                // $user->uuid = UuidGenerator::Uuid(User::all());
                $user->is_employee = true;
                $user->save();
                return $user;
            }
        );
    }


    public function EmployeeDetails(object $employee)
    {
        return app(ServiceWrapper::class)(fn() => $employee);
    }


    public function UpdateEmployee(array $inputs, object $employee)
    {
        return app(ServiceWrapper::class)(fn() => $employee->update($inputs));
    }


    public function DeleteEmployee(object $employee)
    {
        return app(ServiceWrapper::class)(
            function() use($employee)
            {
                if($employee->image)
                    Storage::disk('liara')->delete($employee);
                return $employee->delete();
            }
        );
    }

}
