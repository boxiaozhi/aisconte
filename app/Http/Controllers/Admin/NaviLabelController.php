<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CException;
use App\Models\NaviLabel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use QL\QueryList;

class NaviLabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = NaviLabel::paginate();
        return view('admin.navi.label_index')
            ->with('lists', $lists)
            ->with('title', 'Navi Label')
            ->with('des', 'Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.navi.label_add')
            ->with('title', 'Navi Label')
            ->with('des', 'Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:navi_labels,name',
        ],[
            'name.required' => '请输入名称',
            'name.unique' => '名称已存在，请确认',
        ]);

        $name = trim($request->name);
        $naviLabel = new NaviLabel();
        $naviLabel->name = $name;
        $naviLabel->save();

        return [];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = NaviLabel::findOrfail($id);
        return view('admin.navi.label_edit')
            ->with('info', $info)
            ->with('title', 'Navi Label')
            ->with('des', 'Edit');
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
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required' => '请输入名称',
        ]);

        $name = trim($request->name);

        $exist = NaviLabel::where('name', $name)->first();
        if($exist){
            if($exist['id'] == $id){
                return [];
            } else {
                throw new CException('名称已存在，请检查');
            }
        }
        $naviLabel = NaviLabel::findOrFail($id);
        $naviLabel->name = $name;
        $naviLabel->save();

        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = NaviLabel::destroy($id);
        return [];
    }
}
