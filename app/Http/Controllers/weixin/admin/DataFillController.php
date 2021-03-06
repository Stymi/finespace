<?php

namespace App\Http\Controllers\weixin\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\DataFillRepositoryInterface;

use App\Tool\MessageResult;

class DataFillController extends Controller
{
    private $datafill;

    function __construct(DataFillRepositoryInterface $datafill)
    {
        $this->datafill = $datafill;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = $this->datafill->getTable();
        // dd($table);
        return view('admin.weixinAdmin.database.DataFill')->with('table',$table);
    }

    public function getTableStructure(Request $request)
    {
        $table = $request->input('table');
        // $Structure = new MessageResult;
        $Structure = $this->datafill->getTableStructure($table);
        return $Structure;
    }

    public function submitTableStructure(Request $request)
    {
        $df = $this->datafill->DataFill($request->input());

        $jsonResult = new MessageResult();
        if ($df) {
            $jsonResult->statusCode=1;
            $jsonResult->statusMsg= "批量插入成功";
        }else{
            $jsonResult->statusCode=0;
            $jsonResult->statusMsg= "批量插入失败";
        }
        // dd($request->input());
        return response($jsonResult->toJson());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
}
