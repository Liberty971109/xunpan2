<?php

namespace App\Admin\Controllers;

use App\Models\Ask;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\ImportPost;

class AskController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Ask';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Ask());

        $grid->id('ID');
        $grid->message_name('询盘标题');
        $grid->message('询盘内容');
        $grid->sent_from('询盘发送者');
        $grid->sent_to('询盘接收者');
        $grid->location('地址');
        $grid->source('询盘获得渠道');
        $grid->column('rating','询盘打分')->editable('select', [
            1 => '1', 
            2 => '2', 
            3 => '3',
            4 => '4', 
            5 => '5', 
            6 => '6',
            7 => '7', 
            8 => '8', 
            9 => '9',
            10 => '10'
        ]);
        $grid->column('note','询盘备注')->editable('textarea');
        $grid->column('更多信息')->modal('更多信息',Ask::class);

        $grid->date_time('询盘发送时间');

        // 不在页面显示 `新建` 按钮，因为我们不需要在后台新建用户
        $grid->disableCreateButton();
        
        $grid->actions(function ($actions) {

            // 去掉删除
            $actions->disableDelete();
        
            // 去掉编辑
            $actions->disableEdit();
        
            // 去掉查看
            $actions->disableView();
        });
        

        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
         });

         $grid->tools(function (Grid\Tools $tools){
            $tools->append(new ImportPost());
        });



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
        $show = new Show(Ask::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Ask());
        $form->text('rating');
        $form->text('note');

        return $form;
    }
}
