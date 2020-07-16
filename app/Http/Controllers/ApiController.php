<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function index() {
        $customer = Customer::get()->toJson(JSON_PRETTY_PRINT);
        return response($customer, 200);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
           'first_name' => 'required|max:150',
           'last_name' => 'required|max:150',
           'tel_no' => 'numeric|regex:/(0)[0-9]{9}/',
        ]);

        if ($validator->fails()) {
              return response()->json([
                  "message" => $validator->errors()
              ], 400);
        }

        $customer = new Customer;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->tel_no = $request->tel_no?$request->tel_no:"";
        $customer->save();

        return response()->json([
            "message" => "Customer record created"
        ],201);
    }

    public function show($id) {
        if(Customer::where('id', $id)->exists()) {
              $customer = Customer::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
              return response($customer, 200);
        }else{
              return response()->json([
                "message" => "Customer not found"
              ], 404);
        }
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:150',
            'last_name' => 'required|max:150',
            'tel_no' => 'numeric|regex:/(0)[0-9]{9}/',
        ]);

        if ($validator->fails()) {
              return response()->json([
                  "message" => $validator->errors()
              ], 400);
        }

        if (Customer::where('id', $id)->exists()) {
              $customer = Customer::find($id);
              $customer->update($request->all());

              return response()->json([
                    "message" => "Records updated successfully"
              ], 200);
        } else {
              return response()->json([
                    "message" => "Customer not found"
              ], 404);
        }
    }

    public function destroy ($id) {
        if(Customer::where('id', $id)->exists()) {
              $student = Customer::find($id);
              $student->delete();

              return response()->json([
                    "message" => "Records deleted"
              ], 202);
         } else {
              return response()->json([
                    "message" => "Customer not found"
              ], 404);
        }

    }
}
