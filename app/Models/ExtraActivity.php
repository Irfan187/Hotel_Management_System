<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraActivity extends Model
{
    use HasFactory;
    protected $fillable=[
         'title'
     
    ,'max_child'
   ,'max_adults'
   ,'max_people'
  ,'description'
       ,'price1'
       ,'price2'
     ,'duration',
    'hours',
    'minutes',
    'total',
    'days'
        ,'image'
    ];
}