<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'amount',
        'payment_info',
        'details',
        'status',
        'verified',
        'paid_at',
        'verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'payment_info' => 'json',
        'details' => 'json',
    ];

    /**
     * Status enums
     *
     * @var array
     */
    public static $status = [
        'not_paid' => 0,
        'paid' => 1,
    ];

    /**
     * Status enums
     *
     * @var array
     */
    public static $type = [
        'form' => 1,
        'factor' => 2,
    ];

    public function form()
    {
        if ($this->type == self::$type['form']) {
            return Form::find($this->details['form_id']);
        }

        return null;
    }

    public function factor()
    {
        if ($this->type == self::$type['factor']) {
            return Factor::find($this->details['factor_id']);
        }

        return null;
    }
}
