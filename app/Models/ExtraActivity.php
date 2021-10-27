<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraActivity extends Model
{
    use HasFactory;
    protected $fillable=[
         'title'
     ,'subtitle'
    ,'max_child'
   ,'max_adults'
   ,'max_people'
  ,'description'
       ,'price1'
       ,'price2'
     ,'duration'
     ,'latitude'
    ,'longitude'
        ,'image'
    ];
}