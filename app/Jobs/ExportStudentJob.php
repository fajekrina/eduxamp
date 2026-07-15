<?php

namespace App\Jobs;

use App\Exports\StudentExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportStudentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $columns;

    protected $filename;

    public function __construct($columns, $filename)
    {
        $this->columns = $columns;
        $this->filename = $filename;
    }

    public function handle()
    {
        Excel::store(
            new StudentExport($this->columns),
            'exports/' . $this->filename,
            'public'
        );
    }
}