<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\TableService;
use Illuminate\Http\Request;

class TableController extends Controller
{
//    protected $tableService;
//    public function __construct(TableService $tableService)
//    {
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function store(Request $request)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import(Request $request)
    {
        $result = app(TableService::class)->importTable($request->file('file'));
        if ($result) {
            return response()->apiSuccess($result);
        } else {
            return response()->apiError($result);
        }
    }
}
