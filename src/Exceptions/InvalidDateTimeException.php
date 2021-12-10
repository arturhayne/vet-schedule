<?php
declare(strict_types=1);

namespace VetSchedule\Exceptions;

use Throwable;

class InvalidDateTimeException extends \Exception
{
    const CODE = 1;
    const MESSAGE = 'The datetime_start is not valid.';

    public function __construct(Throwable $previous = null)
    {
        parent::__construct(self::MESSAGE, self::CODE, $previous);
    }
}
