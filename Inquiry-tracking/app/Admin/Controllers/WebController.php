<?php

namespace App\Admin\Controllers;

use App\Models\Web;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class WebController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Web';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Web());
        $grid->id('ID');
        $grid->user_id('用户ID');
        $grid->site_name('网站名称');
        // $grid->site_info('网址')->pluck('url');
        $grid->column('site_info->url', '网址');
        $grid->column('site_info->api_key','API 秘钥');

        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
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
        $show = new Show(Web::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Web());
        $form->text('user_id','用户ID')->rules('required');
        $form->text('site_name','网站名称')->rules('required');
        $form->embeds('site_info','网站信息',function($form){
            $form->text('url','网站网址')->rules('required');
            $form->text('api_key')->default(function(){
                return Str::random(16);
            });
        });



        return $form;
    }
}
