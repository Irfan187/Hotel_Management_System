<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name','price1','price2','description'];

    public function packages(){
        return $this->hasMany('App\Models\Package');
    }
}
