<?php

use Illuminate\Facades\DB;

class GarageTest extends TestCase
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

    public function testGarageCanOccupySpacesOrMakeThemAvailable()
    {
        $this->assertEquals($this->garage->spaces_available, 0);

        $this->garage->makeSpaceAvailable();
        $this->garage->makeSpaceAvailable();

        $this->assertEquals($this->garage->spaces_available, 2);
        $this->assertTrue($this->garage->hasSpacesAvailable());

        $this->garage->makeSpaceOccupied();

        $this->assertEquals($this->garage->spaces_available, 1);

        $this->garage->makeSpaceOccupied();

        $this->assertEquals($this->garage->spaces_available, 0);
        $this->assertFalse($this->garage->hasSpacesAvailable());
    }
}