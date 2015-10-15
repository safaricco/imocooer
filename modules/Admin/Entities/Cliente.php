<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table        = 'clientes';
    protected $fillable     = ['nome' ,'link' ,'logo' ,'ordem' ,'status'];
    protected $primaryKey   = 'id_cliente';
}
