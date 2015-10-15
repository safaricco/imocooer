<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table        = 'newsletters';
    protected $fillable     = ['nome' ,'email'];
    protected $primaryKey   = 'id_newsletter';
}
