<?php

namespace App\Admin\Controllers;

use App\Models\Order2 as Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HistoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '历史记录';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());
        $grid->filter(function($filter){
        
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
        
            // 在这里添加字段过滤器
            $filter->like('account', '账号');
            $filter->like('remark', '标识');
        
        });
        $grid->actions(function ($actions) {
        
            // 去掉删除
            //$actions->disableDelete();
        
            // 去掉编辑
            $actions->disableEdit();
        
            // 去掉查看
            $actions->disableView();
        });
        $grid->disableCreateButton();
        //$grid->disableFilter();
        $grid->disableExport();
        $grid->disableColumnSelector();
        $grid->model()->whereNotNull('deleted_at');
        //$grid->column('id', __('Id'));
        $grid->column('remark', __('标识'));
        $grid->column('account', __('账号'));
        $grid->column('password', __('密码'));
        $grid->column('country_code', __('国家编码'));
        $grid->column('country_name', __('国家名字'));
        //$grid->column('city_code', __('城市编码'));
        $grid->column('city_name', __('城市名字'));
        $grid->column('center_code', __('考场编码'));
        $grid->column('test_time', __('考试时间'));
        $grid->column('status', __('状态'));
        $grid->column('remark2', __('备注'));
        $grid->column('deleted_at', __('删除时间'));
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('account', __('Account'));
        $show->field('password', __('Password'));
        $show->field('country_code', __('Country code'));
        $show->field('country_name', __('Country name'));
        $show->field('city_code', __('City code'));
        $show->field('city_name', __('City name'));
        $show->field('center_code', __('Center code'));
        $show->field('test_time', __('Test time'));
        $show->field('remark', __('Remark'));
        $show->field('remark2', __('Remark2'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->text('account', __('Account'));
        $form->password('password', __('Password'));
        $form->text('country_code', __('Country code'));
        $form->text('country_name', __('Country name'));
        $form->text('city_code', __('City code'));
        $form->text('city_name', __('City name'));
        $form->text('center_code', __('Center code'));
        $form->text('test_time', __('Test time'));
        $form->text('remark', __('Remark'));
        $form->text('remark2', __('Remark2'));
        $form->text('status', __('Status'));

        return $form;
    }
}
