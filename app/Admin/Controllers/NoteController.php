<?php

namespace App\Admin\Controllers;

use App\Models\Note;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler;
use App\Tools\Common;
use QL\QueryList;

class NoteController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Note::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title', '标题');
            $grid->column('tag', '标签');
            $grid->column('url', '链接');
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Note::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '标题');
            $form->text('tag', '标签');
            $form->text('url', '链接');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    /**
     * 获取标题导航数据
     * @return [type] [description]
     */
    public function navList() {
        $data = Note::select('id','title')->orderBy('id', 'desc')->get();
        $temp = [];
        foreach ($data as $d) {
            $temp[] = [
                        'to'   => "/note/".$d['id'],
                        'name' => "{$d['id']}",
                        'type' => '',
                        'des'  => $d['title']
                    ];
        }
        $res['default'] = (string)$data[0]['id'];
        $res['data']    = $temp;
        return response()->json($res);
    }

    /**
     * 获取笔记内容
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getNote(Request $request) {
        $id       = $request->id;
        $noteInfo = empty($id) ? Note::orderBy('id', 'desc')->first() : Note::Where('id', $id)->first();
        $url      = str_replace('/s/', '/api/shares/', $noteInfo->url);
        $res      = Common::cUrl($url);
        $res      = self::contentFormat($res);

        $res['format']  = strpos($res['title'], '.md') ? 'md' : 'common';
        $res['content'] = self::contentDeal($res['content'], $res['format']);
        return response()->json($res);
    }

    /**
     * 数据格式整理
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function contentFormat($data)
    {
        $res['returnCode']    = $data['return_code'];
        $res['returnMessage'] = $data['return_message'];
        $res['title']         = $data['share']['title'];
        $res['content']       = $data['content'];
        $res['readCount']     = $data['share']['readCount'];
        $res['createdAt']     = $data['share']['createdAt'];
        $res['updatedAt']     = $data['share']['updatedAt'];
        return $res;
    }

    /**
     * 笔记内容处理
     * @param  [type] $data   [description]
     * @param  string $format [description]
     * @return [type]         [description]
     */
    public function contentDeal($data, $format='common') {
        switch ($format) { //提取规则
            case 'md':
                $rules = [
                    'body' => ['', 'text', '', function($content){
                        $content = trim($content);
                        return $content;
                    }]
                ];
                break;
            default:
                $rules = [
                    'body' => ['', 'html', '']
                ];
                break;
        }

        $data = QueryList::html($data)->removeHead()->rules($rules)->range('body')->query()->getData();
        $res  = $data->all();
        $res  = $res[0]['body'];

        switch ($format) { //转换规则
            case 'md':
                $Parsedown = new \Parsedown();
                $res       = $Parsedown->text($res);
                break;
        }
        return $res;
    }
}
