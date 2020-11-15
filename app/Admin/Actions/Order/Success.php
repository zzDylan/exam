<?php

namespace App\Admin\Actions\Order;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Success extends RowAction
{
    public $name = '完成';

    public function handle(Model $model)
    {
        // $model ...
        $model->status = '完成';
        $model->save();
        return $this->response()->success('已将订单标记为完成')->refresh();
    }

}