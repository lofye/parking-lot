<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Garage extends Model
{
    protected $fillable = ['spaces_total','spaces_occupied','phone_number','hourly_rate','step_increase'];

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

    public function hasOccupiedSpaces(): bool
    {
        return ($this->spaces_occupied > 0);
    }
}