<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table        = 'eventos';
    protected $fillable     = ['titulo' ,'texto' ,'link' ,'data_inicio' ,'data_evento' ,'ordem' ,'status'];
    protected $primaryKey   = 'id_evento';
}
