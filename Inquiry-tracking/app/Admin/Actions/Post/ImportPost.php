<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AskImport;

class ImportPost extends Action
{
    public $name = '导入数据';
    protected $selector = '.import-post';
    // protected $signature = 'import:excel';

    // protected $description = 'Laravel Excel importer';

    public function handle(Request $request)
    {
        // 下面的代码获取到上传的文件，然后使用`maatwebsite/excel`等包来处理上传你的文件，保存到数据库
        // Excel::import(new UserImport, $request->file);
        Excel::import(new AskImport, $request->file);
        // $this->output->title('Starting import');
        // (new AskImport)->withOutput($this->output)->import($request->file);
        // $this->output->success('Import successful');
        

        return $this->response()->success('导入完成!')->refresh();
    }

    public function form()
    {
        $this->file('file', '请选择文件');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-post">导入数据</a>
HTML;
    }
}