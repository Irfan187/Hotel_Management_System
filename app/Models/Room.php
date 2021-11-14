<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable=['name','image','no_of_beds','description','max_child','max_adults',
                        'max_people','min_people','no_of_rooms','price1','price2','active'];

}
