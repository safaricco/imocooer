<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Sobres extends Model
{
    protected $table        = 'sobre';
    protected $fillable     = ['tiutlo', 'texto'];
    protected $primaryKey   = 'id_sobre';
}
