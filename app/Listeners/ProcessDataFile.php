<?php

namespace App\Listeners;

use App\Events\DataFileInserted;
use App\Jobs\ProcessDataFileJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessDataFile
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
    public function handle(DataFileInserted $event): void
    {
        ProcessDataFileJob::dispatch($event->dataFile);
    }
}
