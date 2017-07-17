<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demo;
use DB;
//use Illuminate\Http\Response;
use Response;

class DemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $restful = true;

    public function get_index($id = null)
    {
        if (is_null($id)) {
            return Response::eloquent(Todo::all());
        } else {
            $demo = Demo::find($id);

            if (is_null($demo)) {
                return Response::json('Todo not found', 404);
            } else {
                return Response::eloquent($demo);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post_index()
    {

        $newdemo = Input::json();

        $demo = new Demo();
        $demo->type = $newdemo->title;
        $demo->save();

        return Response::eloquent($demo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function put_index()
    {
        $updatedemo = Input::json();

        $demo = Demo::find($updatedemo->id);
        if (is_null($demo)) {
            return Response::json('Todo not found', 404);
        }
        $demo->type = $updatedemo->title;
        $demo->completed = $updatedemo->completed;
        $demo->save();
        return Response::eloquent($demo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_index($id = null)
    {
        $demo = Demo::find($id);

        if(is_null($demo))
        {
            return Response::json('Todo not found', 404);
        }
        $deleteddemo = $demo;
        $demo->delete();
        return Response::eloquent($deleteddemo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function store(Request $request) {
        $responseData = [
            'status' => 'fail',
            'message' => 'Type field is required',
            'data' => []
        ];

        $data = $request->json()->all();
        if (!isset($data['type'])) {
            return Response::json($responseData);
        }

        $checkItemExist = Demo::where('type', $data['type'])->first();
        if ($checkItemExist != null && $checkItemExist->id != '') {
            $responseData['message'] = 'Item already exists.';
        } else {
            if (isset($data['type']) & $data['type'] != null & $data['type'] != '') {
                $d = new Demo();
                $d->type = $data['type'];
                $d->save();
                $responseData['status'] = 'success';
                $responseData['message'] = 'Added successfully.';
                $responseData['data'] = [ 'id' => $d->id ];
            }
        }

        return Response::json($responseData);
    }
}
