<?php

namespace App\Modelos\STD;

use Illuminate\Database\Eloquent\Model;

class STDTipoVehiculo extends Model
{
    protected $connection='sqlsrvtel';
    protected $table = 'STD.TipoVehiculo';
    public $timestamps=false;

    protected $primaryKey = 'Id';
    public $incrementing = false;
    public $keyType = 'string';
}
