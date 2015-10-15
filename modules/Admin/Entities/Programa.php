<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $table        = 'programas';
    protected $fillable     = ['titulo' ,'texto', 'codigo' ,'data' ,'status'];
    protected $primaryKey   = 'id_programa';
}
