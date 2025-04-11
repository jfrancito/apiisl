<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class STDVehiculo extends Model
{
    //

    protected $connection='sqlsrvtel';

    protected $table = 'STD.Vehiculo';
    public $timestamps=false;

    protected $primaryKey = 'Id';
    public $incrementing = false;
    public $keyType = 'string';

    public function TipoVehiculo()
    {
        return $this->belongsTo('App\Modelos\STD\STDTipoVehiculo', 'IdTipoVehiculo','Id');
    }

}
