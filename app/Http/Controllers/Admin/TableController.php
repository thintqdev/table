<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TableImport;
use App\Models\Table;
use App\Services\Admin\TableService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = app(TableService::class)->getTables();

        return response()->apiSuccess($result);
    }

    public function store(Request $request)
    {
        $table = app(TableService::class)->createTable($request->all());

        return response()->apiSuccess($table);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        $result = app(TableService::class)->updateTable($table, $request->all());

        if ($result) {
            return response()->apiSuccess($result);
        } else {
            return response()->apiError($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        return response()->apiSuccess($table->forceDelete());
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
