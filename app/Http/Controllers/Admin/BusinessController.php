<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use Illuminate\Support\Facades\Validator;


class BusinessController extends Controller
{
    public function index(){
        $businesses=Business::paginate(30);
        return response()->json($businesses);
    }

    public function store (Request $request){
        $validator=Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'opening_hours' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        Business::create(array_merge($validator->validated()));
        return response()->json('Business is added!');
    }

    public function update(Request $request, $id){
        $business=Business::FindOrFail($id);
        $validator=Validator::make($request->all(), [
            'email' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'opening_hours' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $business->update(array_merge($validator->validated()));
        return response()->json('Business is updated!');
    }

    public function destroy($id){
        $business=Business::FindOrFail($id);
        $business->delete();
        return response()->json('Business is deleted');
    }
}
