<?php
declare(strict_types=1);

namespace VetSchedule\Domain;

use DateTime;
use VetSchedule\Exceptions\InvalidDateTimeException;

class DateTimeCheck
{
    /**
     * @var DateTime
     */
    private $value;

    /**
     * DateTimeCheck constructor.
     * @param string $dateTime
     * @throws InvalidDateTimeException
     */
    public function __construct(string $dateTime)
    {
        $this->validateDate($dateTime);
        $this->value = new DateTime($dateTime);
    }

    /**
     * @param string $dateTime
     * @return static
     * @throws InvalidDateTimeException
     */
    public static function create(string $dateTime) {
        return new static($dateTime);
    }

    /**
     * @param string $dateTime
     * @throws InvalidDateTimeException
     */
    private function validateDate(string $dateTime): void
    {
        if (empty(trim($dateTime)) || !strtotime($dateTime)) {
            throw new InvalidDateTimeException();
        }
    }

    /**
     * @return DateTime
     */
    public function value(): DateTime
    {
        return $this->value;
    }
}
