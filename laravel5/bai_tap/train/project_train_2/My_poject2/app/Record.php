<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //
    protected $table='records';
    protected $fillable=['name','userId','gender','position','offic','age','startDay'];

    public $timestamps=false;
    
}
