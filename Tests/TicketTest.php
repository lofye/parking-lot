<?php

use Illuminate\Facades\DB;

class TicketTest extends TestCase
{
    protected $garage;

    public function setUp() : void
    {
        DB::truncate('garages');

        $garage = new Garage();
        $garage->spaces_total = 10;
        $garage->spaces_occupied = 10;
        $garage->hourly_rate = 3;
        $garage->step_increase = 1.5;
        $garage->save();

        $this->garage = $garage;
    }

    public function testTicketAmountDue()
    {
        $ticket = new Ticket($this->garage);
        $ticket->enter_at = Carbon::parse('2019-04-05 10:00:00');

        // < 1 hour = minimum charge of 1 hour
        $ticket->exit_at = Carbon::parse('2019-04-05 10:45:00');
        $this->assertEquals('$3.00', $ticket->getAmountDue());

        // <= 1 hour
        $ticket->exit_at = Carbon::parse('2019-04-05 11:00:00');
        $this->assertEquals('$3.00', $ticket->getAmountDue());

        // <= 3 hours
        $ticket->exit_at = Carbon::parse('2019-04-05 13:00:00');
        $this->assertEquals('$4.50', $ticket->getAmountDue());

        // <= 6 hours
        $ticket->exit_at = Carbon::parse('2019-04-05 16:00:00');
        $this->assertEquals('$10.13', $ticket->getAmountDue());

        // > 6 hours, aka ALL DAY
        $ticket->exit_at = Carbon::parse('2019-04-05 17:00:00');
        $this->assertEquals('$15.19', $ticket->getAmountDue());
    }
}