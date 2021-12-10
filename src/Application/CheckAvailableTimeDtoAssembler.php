<?php
declare(strict_types=1);

namespace VetSchedule\Application;

interface CheckAvailableTimeDtoAssembler
{
    public function assemble(bool $timeIsAvailable);
}
