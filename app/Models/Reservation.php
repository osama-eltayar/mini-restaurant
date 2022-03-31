<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class Reservation extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'table_id',
        'customer_id',
        'from',
        'to',
    ];

    protected $dates = ['from','to'];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################
    public function scopeOverlap($query,$from,$to)
    {
        return $query->where(function ($query) use ($from, $to) {
            $query->where(function ($query) use ($from) {
                return $query->where('from', '<=', $from)
                             ->where('to', '>=', $from);
            })
                  ->orWhere(function ($query) use ($to) {
                      $query->where('from', '<=', $to)
                            ->where('to', '>=', $to);
                  })
                  ->orWhereBetween('from', [$from, $to])
                  ->orWhereBetween('to', [$from, $to]);
        });
    }


    //########################################### Relations ################################################


}

