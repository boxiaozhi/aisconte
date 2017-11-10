<?php

namespace App\Admin\Controllers;

use App\Models\WizNote;

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

class WizNoteController extends Controller
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
        return Admin::grid(WizNote::class, function (Grid $grid) {

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
        return Admin::form(WizNote::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '标题');
            $form->text('tag', '标签');
            $form->text('url', '链接');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    /**
     * [navList description]
     * @return [type] [description]
     */
    public function navList(){
        $data = WizNote::select('id','title')->orderBy('id', 'desc')->get();
        $temp = [];
        foreach ($data as $d) {
            $temp[] = [
                        'to'   => "/wiznote/".$d['id'],
                        'name' => "{$d['id']}",
                        'type' => '',
                        'des'  => $d['title']
                    ];
        }
        $res['default'] = (string)$data[0]['id'];
        $res['data'] = $temp;
        return response()->json($res);
    }

    /**
     * [getNote description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getNote(Request $request){
        $id = $request->id;
        if(empty($id)){
            $data = WizNote::orderBy('id', 'desc')->first();
        } else {
            $data = WizNote::Where('id', $id)->first();
        }
        $url = str_replace('/s/', '/api/shares/', $data->url);
        $res = Common::cUrl($url);
        $res = self::contentFormat($res);

        if(strpos($res['title'], '.md')){
            $res['md']      = true;
            //$res['content'] = self::htmlToMd($res['content']);
            $res['content'] = self::qlDeal($res['content']);
            //print_r($res['content']);exit;
            $Parsedown = new \Parsedown();
            $res['content'] = $Parsedown->text($res['content']);
            //exit();
        } else {
            $res['md']      = false;
            $res['content'] = self::commonToHtml($res['content']);
        }
        return response()->json($res);
    }

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
     * html 提取 md 信息
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function htmlToMd($data)
    {
        $data = str_replace('charset=unicode', 'charset=utf-8', $data); //指定字符编码
        $crawler = new DomCrawler\Crawler();
        $crawler->addHtmlContent($data);
        $nodeValues = $crawler->filter('div > div')->each(function (DomCrawler\Crawler $node, $i) {
            return $node->text();
        });
        if(empty($nodeValues)){
            $nodeValues = $crawler->filter('div')->each(function (DomCrawler\Crawler $node, $i) {
                return $node->text();
            });
        }
        $text = implode(PHP_EOL, $nodeValues); //换行
        return $text;
    }

    public function commonToHtml($data)
    {
        $data = str_replace('charset=unicode', 'charset=utf-8', $data); //指定字符编码
        $crawler = new DomCrawler\Crawler();
        $crawler->addHtmlContent($data);
        $htmlContent = $crawler->filter('body')->html();
        return $htmlContent;
    }

    /**
     * QueryList Deal Html Page
     * @param  [type] $data [description]
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public function qlDeal($data, $type='html'){
        //$data = str_replace('charset=unicode', 'charset=utf-8', $data);
        $rules = [
            'body' => ['', 'text', '', function($content){
                $content = trim($content);
                return $content;
            }]
        ];
        $data = QueryList::html($data)->removeHead()->rules($rules)->range('body')->query()->getData();
        $res = $data->all();
        return $res[0]['body'];
    }
}
