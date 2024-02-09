<?php

namespace App\Jobs;

use App\Funciones\Storage\cls_storage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class JobTmpDoc implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo "\n";
        echo "Job ejecutado correctamente\n";
        echo "-----------------------------------------------------------------------\n";
        cls_storage::clean_tmp_backup_doc();
        echo "-----------------------------------------------------------------------\n";
        echo "Job terminó correctamente\n";

    }
}
