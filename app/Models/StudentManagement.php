<?php

namespace App\Models;
use App\Jobs\ProcessStudentCsv;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;


class StudentManagement extends Model
{
    use HasFactory;

    protected $fillable = [  //'course_code', 'level', 'semester',
        'id','student_id','surname','other_name', 'semester','program','total','course_code','campus','email'
    ];

    public function exportToDatabase()
    {
        $path = resource_path('pending-result-files/*.csv');
        $files = glob($path);

        foreach ($files as $file) {
            ProcessStudentCsv::dispatch($file);
        }
    }
}
