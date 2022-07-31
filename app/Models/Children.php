<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\String_;

class Children extends Model
{
    use HasFactory;
    protected $fillable= ['name','birthdate','gender'];

    public function Partners()
    {
        return $this->belongsToMany(Partners::class,'childrens_partners','children_id','partner_id');
    }


    public function getgenderAttribute($value) : String {
        return $value  === "0" ? "Female" : "Male";
    }
}
