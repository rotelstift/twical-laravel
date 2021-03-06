<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class CalendarTest extends TestCase
{
    protected function setUp(): void
    {
        $target_date = Carbon::create(2020, 1, 31, 12, 00, 0);
        Carbon::setTestNow($target_date);
        parent::setUp();
    }
    
    protected function tearDown(): void
    {
        parent::tearDown();
        Carbon::setTestNow();
    }

    /**
     * @test
     */
    public function it_shows_today_calendar()
    {
        $response = $this->get('/');

        $responseData = $response->getOriginalContent()->getData();

        $response->assertStatus(200);
        $this->assertEquals("2020", $responseData['year']);
        $this->assertEquals("1", $responseData['month']);
        $this->assertEquals("/2021/01", $responseData['nextYearPath']);
        $this->assertEquals("/2019/01", $responseData['prevYearPath']);
        $this->assertEquals("/2020/02", $responseData['nextMonthPath']);
        $this->assertEquals("/2019/12", $responseData['prevMonthPath']);
    }
    
    /**
     * @test
     */
    public function it_shows_pointed_calendar()
    {
        $response = $this->get('/2019/12');

        $responseData = $response->getOriginalContent()->getData();

        $response->assertStatus(200);
        $this->assertEquals("2019", $responseData['year']);
        $this->assertEquals("12", $responseData['month']);
        $this->assertEquals("/2020/12", $responseData['nextYearPath']);
        $this->assertEquals("/2018/12", $responseData['prevYearPath']);
        $this->assertEquals("/2020/01", $responseData['nextMonthPath']);
        $this->assertEquals("/2019/11", $responseData['prevMonthPath']);
    }
}
