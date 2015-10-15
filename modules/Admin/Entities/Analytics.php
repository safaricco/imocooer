<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    protected $table        = 'analytics';
    protected $fillable     = ['codigo'];
    protected $primaryKey   = 'id_analytics';
}
