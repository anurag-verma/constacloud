<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Students;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('API Token')->plainTextToken;
            // return response()->json([
            //     'user' => auth()->user(),
            //     'token' => $token,
            // ]);
            return response()->json(['message' => 'Authenticated','token' => $token], 200);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function getStudents(Request $request)
    {
        $class = $request->class;
        if(!empty($request->data)){
            $data = explode(',', $request->data);
            $qry = array();
            foreach($data as $filter){
                if($filter == "total"){
                    $qry[] = 'english + hindi + maths + science + social_science as total';
                }
                elseif($filter == "photo"){
                    $qry[] = 'CONCAT("http://localhost:8000/storage/", photo) AS image_url';
                }
                else{
                    $qry[] = $filter;
                }
            }
            $filterData = implode(', ', $qry);
            $totalStudents = Students::select(DB::raw($filterData))
            ->get();
        }
        else{
        $totalStudents = Students::select(DB::raw('name, roll_num, english, hindi, maths, science, social_science, english + hindi + maths + science + social_science as total,stu_class, CONCAT("http://localhost:8000/storage/", photo) AS image_url'))
        ->when(!empty($class), function ($query) use ($class) {
            return $query->where('stu_class', $class);
        })
        ->orderBy('total','desc')->get();
        }
        if(count($totalStudents)){
            return response()->json($totalStudents, 200);
        }else{
            return response()->json("No Data!", 200);
        }
    }
}
