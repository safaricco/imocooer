<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    protected $table        = 'funcao';
    protected $fillable     = ['nome', 'descricao' ,'status'];
    protected $primaryKey   = 'id_funcao';
}
