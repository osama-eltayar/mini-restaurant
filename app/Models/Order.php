<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static self create(array $data)
 */
class Order extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'table_id',
        'reservation_id',
        'customer_id',
        'waiter_id',
        'total_paid',
    ];

    //########################################### Constants ################################################


    //########################################### Accessors ################################################


    //########################################### Mutators #################################################


    //########################################### Scopes ###################################################


    //########################################### Relations ################################################
    public function details()
    {
        return $this->belongsToMany(Meal::class,OrderDetails::class)->withPivot(['amount_to_pay'])->withTimestamps();
    }

    public function waiter()
    {
        return $this->belongsTo(Waiter::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }


}

