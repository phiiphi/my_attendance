<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\StudentManagement;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('can_manage_students')) {
            return abort(401);
        }
    
        $student_management = StudentManagement::all();
    
        return view('admin.student.index', compact('student_management'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function exportStudentCsv(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:10000|mimes:xlsx,xls,csv,txt',
        ]);

        if ($validator->fails()) {
            # display error messages
            Alert::toast('The file format is not supported', 'error');
            return redirect()->back();
        } else {


            $file = file($request->file->getRealPath());
            $extension = $request->file->getClientOriginalExtension();

            $data = array_slice($file, 1);

            #count total data in csv
            $total_data = count($file) - 1;

            #break the huge data into parts
            $parts = (array_chunk($data, 1000));

            foreach ($parts as $index => $part) {
                $fileName = resource_path('pending-result-files/' . date('y-m-d-H-i-s') . $index . '.' . $extension);
                file_put_contents($fileName, $part);
            }

            #retrieve file
            // $get_file = resource_path($fileName);
             //CalculateGrade::calculateGrade($fileName);

            //dd("STOP");


            $exportResults = new StudentManagement();
            $exportResults->exportToDatabase();

            Alert::toast( $total_data.' Data Successfully Added to Results', 'success');
            return redirect()->route('admin.student.index');

        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentManagement $student_management)
    {
        //
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $student_management->delete();

        return redirect()->route('admin.permissions.index');
    }
    
    public function massDestroy(Request $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
