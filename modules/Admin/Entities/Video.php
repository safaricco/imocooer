<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table        = 'videos';
    protected $fillable     = ['titulo' ,'texto' ,'link' ,'ordem' ,'status'];
    protected $primaryKey   = 'id_video';
}
