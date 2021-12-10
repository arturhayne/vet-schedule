<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use VetSchedule\Application\CheckAvailableTimeDtoAssembler;
use VetSchedule\Application\CheckAvailableTimeQueryHandler;
use VetSchedule\Application\HttpCheckAvailableTimeDto;
use VetSchedule\Domain\SchedulingService;
use VetSchedule\Infrastructure\FileAppointmentsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Repository
        $this->app
            ->when(CheckAvailableTimeQueryHandler::class)
            ->needs(SchedulingService::class)
            ->give(FileAppointmentsRepository::class);

        // DTO
        $this->app
            ->when(CheckAvailableTimeQueryHandler::class)
            ->needs(CheckAvailableTimeDtoAssembler::class)
            ->give(HttpCheckAvailableTimeDto::class);
    }
}
