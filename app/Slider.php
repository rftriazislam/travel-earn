<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table='sliders';
    protected $fillable = [
       'slider_name','slider_title','slider_iamge'
    ];
}
