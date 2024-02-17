<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function saveStudent(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'roll_number' => 'required|unique:students,roll_num',
            'class' => 'required',
            'english' => 'required',
            'hindi' => 'required',
            'maths' => 'required',
            'science' => 'required',
            'social_studies' => 'required',
            'photo' => 'required|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            $message = $validator->getMessageBag()->toArray();
            return response()->json(['error' => $message]);
        }
        $file = $request->file('photo');
        $filename = $file->getClientOriginalName();
        $filename = str_replace(" ", "-", $filename);
        $filename = preg_replace('/[^A-Za-z0-9\-_]+/', '', $filename);
        $filename .= Str::random(10);
        $photo = $file->storeAs('/student_photos', $filename . "." . $file->getClientOriginalExtension(), 'public');


        $student = new Students;
        $student->name = $request->name;
        $student->roll_num = $request->roll_number;
        $student->stu_class = $request->class;
        $student->english = $request->english;
        $student->hindi = $request->hindi;
        $student->maths = $request->maths;
        $student->science = $request->science;
        $student->social_science = $request->social_studies;
        $student->photo = $photo;
        $student->save();
        return response()->json(['success' => 'Student Marks Added!']);
    }

    public function getStudents(Request $request)
    {
        DB::enableQueryLog();
        $columns = array(
            0 => 'id',
            1 => 'roll_num',
            2 => 'name',
            3 => 'stu_class',
            4 => 'english',
            5 => 'hindi',
            6 => 'maths',
            7 => 'science',
            8 => 'social_science',
            9 => 'class',
        );
        $totalData = Students::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $students = Students::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        $totalFiltered = Students::count();
        $data = $customResult = array();
        if (!empty($students)) {
            $count = 1;
            foreach ($students as $student) {
                $customResult['id'] = $student->id;
                $customResult['roll_num'] = "<strong><p class='mb-2'>".$student->roll_num."</a></p></strong>";
                $customResult['name'] = "<strong><p class='mb-2'>".$student->name."</a></p></strong>";
                $customResult['class'] = $student->stu_class;
                $customResult['english'] = $student->english;
                $customResult['hindi'] = $student->hindi;
                $customResult['maths'] = $student->maths;
                $customResult['science'] = $student->science;
                $customResult['social_science'] = $student->social_science;
                $customResult['photo'] = "<img src='".asset('storage/'.$student->photo)."' style='height:60px;padding:4px;'>";
                $data[] = $customResult;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
        );
        return json_encode($json_data);
    }
}
