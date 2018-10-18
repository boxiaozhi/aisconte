<?php

namespace App\Http\Controllers\Admin;

use App\Models\NaviInfo;
use App\Models\NaviLabel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NaviInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = NaviInfo::paginate();

        return view('admin.navi.info_index')
            ->with('lists', $lists)
            ->with('title', 'NaviInfo')
            ->with('des', 'Base Info');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $labels = NaviLabel::all();
        return view('admin.navi.info_add')
            ->with('labels', $labels)
            ->with('title', 'NaviInfo')
            ->with('des', 'Add');
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
            'name' => 'required|unique:navi_infos,name',
            'url' => 'required|unique:navi_infos,url',
            'label' => 'required',
        ],[
            'name.required' => '请输入名称',
            'name.unique' => '名称已存在，请确认',
            'url.required' => '请输入 url',
            'url.unique' => 'url 已存在，请确认',
            'label.required' => '请选择标签',
        ]);

        $name = trim($request->name);
        $url = trim($request->url);
        $label = trim($request->label);

        $naviInfo = new NaviInfo();
        $naviInfo->name = $name;
        $naviInfo->url = $url;
        $naviInfo->label = (array)explode(',', $label);
        $naviInfo->save();

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
        $info = NaviInfo::findOrfail($id);
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
