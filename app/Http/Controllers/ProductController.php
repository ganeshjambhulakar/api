<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ApiException;

class ProductController extends Controller
{
    public function products()
    {
        $return = [];
        try {
            $data = Products::all();
            $return = [
                'status' => 'success',
                'code' => 200,
                'data' => $data,
            ];
        } catch (ApiException $e) {
            $return = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'errors' => $e->getMessages(),
            ];
        }
        return response()->json($return);
    }

    public function create(Request $request)
    {
        $return = [];
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required',
                'categery' => 'required',
                'description' => 'required',
                'price' => 'required',
                'qty' => 'required',

            ]);

            if ($validator->fails()) {
                throw new ApiException(__('validation.custom.invalid_fields'), 400, null, $validator->errors());
            }
            $obj = new Products();
            $obj->name = $request->post('name');
            $obj->categery = $request->post('categery');
            $obj->description = $request->post('description');
            $obj->price = $request->post('price');
            $obj->qty = $request->post('qty');

            $data = $obj->save();
            $return = [
                'status' => 'success',
                'code' => 201,
                'data' => $data,
            ];
        } catch (ApiException $e) {
            $return = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'errors' => $e->getMessages(),
            ];
        }
        return response()->json($return);
    }
    public function update(Request $request, $id = false)
    {
        $return = [];
        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required',
                'categery' => 'required',
                'description' => 'required',
                'price' => 'required',
                'qty' => 'required',

            ]);

            if ($validator->fails()) {
                throw new ApiException(__('validation.custom.invalid_fields'), 400, null, $validator->errors());
            }
            $obj = Products::find($id);
            $obj->name = $request->post('name');
            $obj->categery = $request->post('categery');
            $obj->description = $request->post('description');
            $obj->price = $request->post('price');
            $obj->qty = $request->post('qty');
            $data = $obj->update();
            $return = [
                'status' => 'success',
                'code' => 204,
                'data' => $data,
            ];
        } catch (ApiException $e) {
            $return = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'errors' => $e->getMessages(),
            ];
        }
        return response()->json($return);
    }
    public function delete(Request $request, $id = false)
    {
        $return = [];
        try {
            $data = Products::find($id)->delete();
            $return = [
                'status' => 'success',
                'code' => 200,
                'data' => $data,
            ];
        } catch (ApiException $e) {
            $return = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'errors' => $e->getMessages(), 
            ];
        }
        return response()->json($return);
    }
    public function singlepruduct(Request $request, $id = false)
    {
        $return = [];
        try {
            $data = Products::find($id);
            $return = [
                'status' => 'success',
                'code' => 200,
                'data' => $data,
            ];
        } catch (ApiException $e) {
            $return = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'errors' => $e->getMessages(),
            ];
        }
        return response()->json($return);
    }
}
