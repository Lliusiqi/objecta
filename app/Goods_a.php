<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods_a extends Model
{
    protected $table='goods_a';
    protected $primarykey='goods_id';
    public $timestamps = true;
    const CREATED_AT = 'create_at';
}
