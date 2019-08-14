<?php

namespace App\Admin\Controllers;

use App\Models\NavInfo;
use App\Models\NavLabel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NavInfoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\NavInfo';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NavInfo);

        $grid->column('id', __('Id'));
        $grid->column('label', __('Label'))->display(function($labelIds){
            $labelName = NavLabel::whereIn('id', $labelIds)->pluck('name');
            return $labelName;
        })->label();
        $grid->column('name', __('Name'));
        $grid->column('url', __('Url'));
        $grid->column('detail', __('Detail'));
        $grid->column('deleted_at', __('Deleted at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(NavInfo::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('label', __('Label'))->label();
        $show->field('name', __('Name'));
        $show->field('url', __('Url'));
        $show->field('detail', __('Detail'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new NavInfo);

        $form->multipleSelect('label', __('Label'))->options(function(){
            $labels = NavLabel::all()->pluck('name', 'id');
            return $labels;
        });
        $form->text('name', __('Name'));
        $form->url('url', __('Url'));
        $form->text('detail', __('Detail'));

        return $form;
    }
}
