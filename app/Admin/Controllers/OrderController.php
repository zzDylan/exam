<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());
        $grid->disableExport();
        $grid->disableColumnSelector();
        $grid->column('id', __('Id'));
        $grid->column('account', __('账号'));
        $grid->column('password', __('密码'));
        $grid->column('country_code', __('国家编码'));
        $grid->column('country_name', __('国家名字'));
        $grid->column('city_code', __('城市编码'));
        $grid->column('city_name', __('城市名字'));
        $grid->column('center_code', __('考场编码'));
        $grid->column('test_time', __('考试时间'));
        // $grid->column('card_num', __('支付卡号'));
        // $grid->column('card_type', __('卡类型'));
        // $grid->column('card_security', __('卡安全码'));
        // $grid->column('card_expire_month', __('卡过期月份'));
        // $grid->column('card_expire_year', __('卡过期年份'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

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
        $show->field('account', __('账号'));
        $show->field('password', __('密码'));
        $show->field('country_code', __('国家编码'));
        $show->field('country_name', __('国家名字'));
        $show->field('city_code', __('城市编码'));
        $show->field('city_name', __('城市名字'));
        $show->field('center_code', __('考场编码'));
        $show->field('test_time', __('考试时间'));
        // $show->field('card_num', __('卡号'));
        // $show->field('card_type', __('卡类型'));
        // $show->field('card_security', __('卡安全码'));
        // $show->field('card_expire_month', __('卡有效期月份'));
        // $show->field('card_expire_year', __('卡有效期年份'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

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

        $form->text('account', __('账号'));
        $form->password('password', __('密码'));
        $form->text('country_code', __('国家编码'));
        $form->text('country_name', __('国家名字'));
        $form->text('city_code', __('城市编码'));
        $form->text('city_name', __('城市名字'));
        $form->text('center_code', __('考场编码'));
        $form->datetime('test_time','考场时间')->format('YYYYMM');
        // $form->text('card_num', __('卡号'));
        // $form->text('card_type', __('卡类型'));
        // $form->text('card_security', __('卡安全码'));
        // $form->select('card_expire_month', __('卡有效期月份'))->options(['01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December']);
        // $yearArr = [];
        // for($i=20;$i<=49;$i++){
        // 	$yearArr[$i] = '20'.$i;
        // }
        // $form->select('card_expire_year', __('卡有效期年份'))->options($yearArr);

        return $form;
    }
}
