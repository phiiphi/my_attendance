<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use App\Models\StudentManagement;


class ProcessStudentCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file)
    {
        $this->file = $file;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Redis::throttle('upload-csv')->allow(1)->every(5)->then(function () {
            // Job logic...
           #dump('Proccessing this file:---', $this->file);
           #Alert::toast('Processing this file','success');

            $data = array_map('str_getcsv', file($this->file));

          
            foreach($data as $row)
            {

                StudentManagement::firstOrCreate([
                    'student_id'  => $row[0],
                    'surname'     => $row[1],
                    'other_name'  => $row[2],
                   
                ],[
                    'semester'    => $row[3],
                    'program'     => $row[4],
                    'total'       => $row[5],
                    'course_code' => $row[6],
                    'campus'      => $row[7],
                    'email'       => $row[8]
                ]);
            }

           # dump('Done proccessing this file:---', $this->file);
           #Alert::toast('Done Processing this file','success');

            unlink($this->file);
        }, function () {
            // Could not obtain lock...
            return $this->release(1);
        });
    }
}
