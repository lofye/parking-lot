<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Models\Garage;

class Ticket extends Model
{
    protected Garage $garage;

    /*
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = [
        'enter_at',
        'exit_at',
        'paid_at'
    ];

    public function __construct(Garage $garage)
    {
        $this->garage = $garage;
        $this->duration = abs($this->enter_at->diffInHours($this->exit_at));
    }

    public function distribute()
    {
        $this->garage->makeSpaceOccupied();
        $this->enter_at = Carbon::parse(time());
        $this->save();
    }

    public function exit()
    {
        $this->exit_at = Carbon::parse(time());
        $this->save();
    }

    public function markAsPaid()
    {
        $this->garage->makeSpaceAvailable();
        $this->paid_at = Carbon::parse(time());
        $this->save();
    }

    public function getAmountDue()
    {
        if (empty($this->enter_at) || empty($this->exit_at)) {
            throw new \Exception('Invalid Ticket. Please Call Parking Attendant at ' . $this->garage->attendant_phone_number);
        }

        $duration = $this->duration;

        $hourly_rate = $this->garage->hourly_rate;//i.e. 3
        $step_increase = $this->garage->step_increase;//i.e. 1.5

        if ($duration > 6) {
            //charge ALL DAY rate should be $15.19 assuming hourly_rate $3, step increase 50%
            $amount_due = (($hourly_rate * $step_increase) * $step_increase) * $step_increase;
        } elseif ($duration > 3) {
            //charge for 6 hours should be $10.13 assuming hourly_rate $3, step increase 50%
            $amount_due = ($hourly_rate * $step_increase) * $step_increase;
        } elseif ($duration > 1) {
            //charge for 3 hours should be $4.50 assuming hourly_rate $3, step increase 50%
            $amount_due = $hourly_rate * $step_increase;
        } else {
            //charge 1 hour minimum should be $3.00 assuming hourly_rate $3, step increase 50%
            $amount_due = $hourly_rate * 1;
        }

        setlocale(LC_MONETARY, 'en_US.UTF-8');
        return money_format('%.2n', $amount_due);
    }

    public function show()
    {
        try {
            $amount_due = $this->getAmountDue();
        } catch (\Exception $e) {
            $amount_due = 'N/A';
        }

        return ['enter_at' => $this->enter_at->format('Y-m-d H:i:s'),
                'exit_at' => $this->exit_at->format('Y-m-d H:i:s'),
                'paid_at' => $this->paid_at->format('Y-m-d H:i:s'),
                'duration' => $this->duration,
                'amount_due' => $amount_due];
    }
}