<?php

namespace App\Jobs;

use App\Imports\StudentImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use File;

class ImportStudentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function handle()
    {
        $path = storage_path('app/imports/'.$this->filename);

        Excel::import(
            new StudentImport(),
            $path
        );

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}