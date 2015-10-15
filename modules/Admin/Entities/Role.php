<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table        = 'role';
    protected $fillable     = ['descricao' ,'status'];
    protected $primaryKey   = 'id_role';
}
