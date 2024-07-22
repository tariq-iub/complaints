<?php

namespace App\Jobs;

use App\Models\DataFile;
use App\Models\SensorData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

class ProcessDataFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected DataFile $dataFile;

    /**
     * Create a new job instance.
     */
    public function __construct(DataFile $dataFile)
    {
        $this->dataFile = $dataFile;
    }

    /**
     * Execute the job.
     * @throws UnavailableStream
     */
    public function handle(): void
    {
        $filePath = $this->dataFile->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            $csv = Reader::createFromPath(Storage::disk('public')->path($filePath), 'r');
            $csv->setHeaderOffset(0);
            $rows = $csv->getRecords();

            foreach ($rows as $row) {
                SensorData::create([
                    'data_file_id' => $this->dataFile->id,
                    'timestamp' => $row['timestamp'],
                    'V1' => $row['V1'],
                    'I1' => $row['I1'],
                    'P1' => $row['P1'],
                    'Q1' => $row['Q1'],
                    'E1' => $row['E1'],
                    'V2' => $row['V2'],
                    'I2' => $row['I2'],
                    'P2' => $row['P2'],
                    'Q2' => $row['Q2'],
                    'E2' => $row['E2'],
                    'V3' => $row['V3'],
                    'I3' => $row['I3'],
                    'P3' => $row['P3'],
                    'Q3' => $row['Q3'],
                    'E3' => $row['E3'],
                    'temperature' => $row['temperature'],
                    'misc1' => $row['misc1'],
                    'misc2' => $row['misc2'],
                    'misc3' => $row['misc3'],
                    'misc4' => $row['misc4'],
                    'misc5' => $row['misc5'],
                ]);
            }
        }
    }
}
