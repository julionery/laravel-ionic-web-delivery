<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Oauth_client extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'secret',
        'name'
    ];
}
