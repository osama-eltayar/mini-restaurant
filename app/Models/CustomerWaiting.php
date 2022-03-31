<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class CustomerWaiting extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'customer_id', 'table_id', 'from', 'to'
    ];

    protected $dates = ['from', 'to'];
    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################


}

