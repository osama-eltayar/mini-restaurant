<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class Table extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
    ];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################
    public function scopeCapacity($query,$capacity)
    {
        return $query->where('capacity','>=',$capacity);
    }


    //########################################### Relations ################################################
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }


}

