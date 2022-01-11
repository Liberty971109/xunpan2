<?php

namespace App\Http\Controllers;

use App\Imports\AskImport;
use App\Models\Ask;
use App\Models\Test;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MessageController extends Controller
{
    //
    
    public function import(Request $request){
        Excel::import(new AskImport,$request->file('file'));
        return '上传成功';
    }

    public function index()
    {
        return view('import-from');
    }

    public function importmessage(Request $request){
        // return '666';
        Test::create([
            'message' =>'666',
        ]);
        // $net = $_SERVER['HTTP_HOST'];
        // $ask = Ask::query()->where('site_name',$request->site_name);  
        // if($ask->api_key == $request->api_key){
        //     Ask::create([
        //         'site_id' => $request->site_id,
        //         'message_name' => $request->message_name,
        //         'message' => $request->message,
        //         'sent_from' => $request->sent_from,
        //         'sent_to' => $request->sent_to,
        //         'location' => geoip($request->location)->country.'-'.geoip($request->location)->city,
        //         'source' => $request->source,
        //         'date_time' =>date('Y年m月d日 ',strtotime($request->date)).' '.$request->time,
        //     ]); 
        //     return 1;
        // }else {
        //     return 0;
        // }

        
    }
}
