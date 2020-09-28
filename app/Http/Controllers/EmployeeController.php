<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Employee = Employee::where('role',2)->get();
        return view('Employee.list',compact('Employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Employee.add_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ip = $this->getIp();
        $data = \Location::get($ip);
        $ip1=$data->ip;
        $country=$data->countryName;
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'contact_number' => 'required|max:10|min:10|unique:users',
            'office_location' => 'required',
            'salary' => 'required',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        
        $input = $request->all();
        $input['ip']= $ip1;
        $input['cordinate_country']=$country;
        $input['password']=Hash::make($request['password']);
        Employee::create($input);
        return response()->json(['success'=>'Record is successfully added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('Employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $employee = Employee::find($id);  
      return view('Employee.add_edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $ip = $this->getIp();
        $data = \Location::get($ip);
        $ip1=$data->ip;
        $country=$data->countryName;
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'contact_number' => 'required|max:10|min:10',
            'office_location' => 'required',
            'salary' => 'required',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $userData = employee::find($id);
        $userData->name = request('name');
        $userData->email = request('email');
        $userData->contact_number = request('contact_number');
        $userData->office_location = request('office_location');
        $userData->ip = $ip1;
        $userData->cordinate_country = $country;
        $userData->salary = request('salary');
        $userData->save();
        return response()->json(['success'=>'Record is successfully Updated']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Employee::find($id)->delete();
       $userData = Employee::where('role',2)->get();
       return json_encode(array('data'=>$userData));
    }

    public function status_change(Request $request,$id)
    {
        $userData = employee::find($id);
        if(request('status')==1){
            $userData->status = 0;
            $msg="Employee Inactivated successfully";
        }else{
          $userData->status = 1;
          $msg="Employee Activated successfully";  
        }
        $userData->save();
        return response()->json(['success'=>$msg]);
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }
}
