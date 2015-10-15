<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Dica extends Model
{
    protected $table        = 'dicas';
    protected $fillable     = ['titulo' , 'texto' ,'data' ,'ordem' ,'status'];
    protected $primaryKey   = 'id_dica';
}
