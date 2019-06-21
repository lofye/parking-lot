<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Garage;

class Ticket extends Model
{
    protected $fillable = ['enter_at','exit_at','paid_at'];

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

    public function distribute(Garage $garage)
    {
        $this->garage_id = $garage->id;
        $garage->makeSpaceOccupied();
        $this->enter_at = Carbon::parse(time());
        $this->save();
    }

    public function recordExit()
    {
        $this->exit_at = Carbon::now();
        $this->save();
    }

    public function markAsPaid(Garage $garage)
    {
        $garage->makeSpaceAvailable();
        $this->paid_at = Carbon::now();
        $this->save();
    }

    protected function calculateDuration()
    {
        if(!empty($this->exit_at)){
            return abs($this->enter_at->diffInHours($this->exit_at));
        } else {
            return abs($this->enter_at->diffInHours(Carbon::now()));
        }
    }

    public function getAmountDue(Garage $garage)
    {
        $duration = $this->calculateDuration();

        $hourly_rate = $garage->hourly_rate;//i.e. 3
        $step_increase = $garage->step_increase;//i.e. 1.5

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

    public function show(Garage $garage)
    {
        return ['id' => $this->id,
                'enter_at' => (!empty($this->enter_at) ? $this->enter_at->format('Y-m-d H:i:s') : 'N/A'),
                'exit_at' => (!empty($this->exit_at) ? $this->exit_at->format('Y-m-d H:i:s') : 'N/A'),
                'paid_at' => (!empty($this->paid_at) ? $this->paid_at->format('Y-m-d H:i:s') : 'N/A'),
                'duration' => $this->calculateDuration(),
                'amount_due' => $this->getAmountDue($garage)];
    }
}