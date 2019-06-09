<?php

namespace Models;

use Illuminate\Facades\DB;

class Garage extends Model
{
    protected $spaces_total;
    protected $spaces_occupied;
    public $attendant_phone_number;
    public $hourly_rate;//assume this location charges $3/hr
    public $step_increase;//assume this location's increase is 50% per step, aka multiply by 1.5

    public function makeSpaceAvailable(): bool
    {
        try {
            DB::beginTransaction();
            $this->spaces_occupied--;
            $this->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function makeSpaceOccupied(): bool
    {
        try {
            DB::beginTransaction();
            $this->spaces_occupied++;
            $this->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getSpacesAvailableAttribute(): int
    {
        $this->refresh();
        return ($this->spaces_total - $this->spaces_occupied);
    }

    public function hasSpacesAvailable(): bool
    {
        $this->refresh();
        return ($this->spaces_occupied < $this->spaces_total);
    }
}