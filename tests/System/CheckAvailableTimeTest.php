<?php

use Illuminate\Http\Response;

class CheckAvailableTimeTest extends TestCase
{
    /**
     * @test
     * @dataProvider availableDateTimeProvider
     * @param string $dateTime
     */
    public function it_should_return_available_true_for_no_booked_date_time(string $dateTime): void
    {
        $response = $this->get('/checkTime/' . $dateTime);
        $response->assertResponseStatus(Response::HTTP_OK);
        $result = json_decode($response->response->getContent(), true);
        $this->assertTrue($result['available']);
    }

    /**
     * @return string[][]
     */
    public function availableDateTimeProvider(): array
    {
        return [
            'different_timezone_offset_before_appointments' => ['2020-11-30T10:00:00-04:00'],
            'different_timezone_offset_after_appointments'  => ['2020-11-30T10:00:00-08:00'],
            'available'                                     => ['2020-11-29T11:00:00-05:00'],
            'available_between_blocks'                      => ['2020-11-30T16:00:00-05:00'],
        ];
    }

    /**
     * @test
     * @dataProvider notAvailableDateTimeProvider
     * @param string $dateTime
     */
    public function it_should_return_available_false_for_booked_date_time(string $dateTime): void
    {
        $response = $this->get('/checkTime/' . $dateTime);
        $response->assertResponseStatus(Response::HTTP_OK);
        $result = json_decode($response->response->getContent(), true);
        $this->assertFalse($result['available']);
    }

    /**
     * @return string[][]
     */
    public function notAvailableDateTimeProvider(): array
    {
        return [
            'block_different_timezone_offset' => ['2020-11-30T11:00:00-06:00'],
            'block_exists'                    => ['2020-11-30T10:00:00-05:00']
        ];
    }

    /**
     * @test
     * @dataProvider invalidDateTimeProvider
     * @param string $dateTime
     */
    public function it_should_return_available_false_for_invalid_date_time(string $dateTime): void
    {
        $response = $this->get('/checkTime/' . $dateTime);
        $response->assertResponseStatus(Response::HTTP_BAD_REQUEST);
        $result = json_decode($response->response->getContent(), true);
        $this->assertFalse($result['available']);
        $this->assertEquals('error', $result['status']);
    }

    /**
     * @test
     * @dataProvider invalidDateTimeProvider
     * @param string $dateTime
     */
    public function it_should_return_not_found_when_empty_date_time(): void
    {
        $response = $this->get('/checkTime/');
        $response->assertResponseStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @return string[][]
     */
    public function invalidDateTimeProvider(): array
    {
        return [
            'empty_date'          => [' '],
            'invalid_date'        => ['2222-99-85T08:00:00-ABC123'],
            'string_instead_date' => ['string'],
        ];
    }
}
