<?php

namespace App\Admin\Controllers;

use App\Models\Card;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CardController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(trans('支付卡'))
            //->description(trans('admin.description'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header(trans('admin.detail'))
            ->description(trans('admin.description'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header(trans('admin.edit'))
            ->description(trans('admin.description'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header(trans('admin.create'))
            ->description(trans('admin.description'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Card);

        $grid->id('ID');
        $grid->card_num('卡号');
        $grid->card_type('卡类型');
        $grid->card_security('卡安全码');
        $grid->card_expire_month('卡有效期月份');
        $grid->card_expire_year('卡有效期年份');
        // $grid->created_at(trans('admin.created_at'));
        // $grid->updated_at(trans('admin.updated_at'));

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
        $show = new Show(Card::findOrFail($id));

        $show->id('ID');
        $show->card_num('card_num');
        $show->card_type('card_type');
        $show->card_security('card_security');
        $show->card_expire_month('card_expire_month');
        $show->card_expire_year('card_expire_year');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Card);

        //$form->display('ID');
        $form->text('card_num', '卡号')->rules('required');
        $form->select('card_type', __('卡类型'))->options(['AX'=>'American Express','DI'=>'Discover / Diners Club','JC'=>'JCB','MC'=>'Mastercard','VI'=>'Visa'])->rules('required');
        $form->text('card_security', '卡安全码')->rules('required');
        $form->select('card_expire_month', __('卡有效期月份'))->options(['01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'])->rules('required');
        $yearArr = [];
        for($i=20;$i<=49;$i++){
        	$yearArr[$i] = '20'.$i;
        }
        $form->select('card_expire_year', __('卡有效期年份'))->options($yearArr)->rules('required');
        // $form->display(trans('admin.created_at'));
        // $form->display(trans('admin.updated_at'));

        return $form;
    }
}
