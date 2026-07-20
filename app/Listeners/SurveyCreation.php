<?php

namespace App\Listeners;

use App\Events\GenerateSurvey;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SurveyCreation implements ShouldQueue
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(GenerateSurvey $event): void
    {
        //
        ds($event);
    }
}
