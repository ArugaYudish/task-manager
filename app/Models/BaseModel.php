<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function commonMethod()
    {
        return "This is a common method";
    }

    // Pengunaan Overloading -> Magic Methods Pada laravel yaitu __call

    public function __call($method, $parameters)
    {
        if ($method == 'findByName') {
            return static::where('name', $parameters[0])->first();
        }

        return parent::__call($method, $parameters);
    }
}
