<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use Validator;

class TestController extends Controller
{
   
   	/* get all the items */
	public function index(Request $request){
		$leftItems = Items::where('item_position',1)->orderBy('id','asc')->get()->toArray();
		$rightItems = Items::where('item_position',2)->orderBy('id','asc')->get()->toArray();
		return view('test.index',compact('leftItems','rightItems'));
	}

	/* add item */
	public function addItem(Request $request){
		$input = $request->all();
		//validation rules
		$validator = Validator::make($request->all(), [ 
            'title' => 'required|unique:items,title'
        ]);

		if ($validator->fails()) { 
            $errors = $validator->errors();
            $arr_error = '';
            foreach ($errors->toArray() as $key => $value) {
                foreach ($value as $k => $err_val) {
                    $arr_error .= $err_val."\n";
                }
            }
            $data =   $arr_error;            
            return response()->json(['status' => 0, 'message'=> 'This item name has already been taken. Please enter different name.'], 200);
        }

        $input['item_position'] = 1;
        $input['created_at'] = date('Y-m-d H:i:s');
        $input['updated_at'] = date('Y-m-d H:i:s');
        $input ['status'] = 1;
        $lastId = Items::create($input)->id; //add item to database
        if($lastId){
        	$data ['status'] = 1;
        	$data ['id'] = $lastId;
        	$data ['title'] = $input['title'];
        	$data['message'] = 'Success ! Item has been added successfully';
        }else{
        	$data ['status'] = 0;
        	$data['message'] = 'Something went wrong. Please try again';
        }        
        echo json_encode($data);
	}


	/* Swap items from left to right OR right to left */
	public function swapItems(Request $request){
		$input = $request->all();
		$data['item_position'] = $input['item_position'];
		Items::where('id', $input['id'])->update($data);
		echo json_encode($input);
	}

}
