<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TbLogMigrarPanelDist extends Model
{

    protected $table = 'TbLogMigrarPanelDist';
    public $timestamps=false;
    protected $primaryKey = 'Id';
    public $incrementing = false;
    public $keyType = 'string';

}
