<?php

namespace App\Imports;

use App\Models\Ask;
use App\Models\Message; 
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpParser\Node\Expr\Cast\String_;
use Encore\Admin\Facades\Admin;

class AskImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        $message_name = $row['original_subject'];
        $sent_to = $row['original_to'];
        $strs = $row['original_message'];
        // var_dump($strs);
        $arrs = explode('<br>', $strs);
        // // var_dump($arrs);
        $arrs = str_replace("---","",$arrs);
        $arrs = array_filter($arrs);
        array_splice($arrs,0,0);
        // // var_dump($arrs);
        // // print_r(count($arrs));
        $key = [];
        $value = [];
        foreach($arrs as $arr){
            $status = strpos($arr,"Message");
        //     // var_dump($status);
        //     // var_dump($arr);
            
                try{
                    if( $status !== false ){
                        $new_arr = explode('Message: ', $arr);
                        $new_arr[0] = "Message";
                        array_push($key,$new_arr[0]);
                        array_push($value,$new_arr[1]);
                        // var_dump($new_arr); 
                    } else {
                        $new_arr = explode(': ', $arr);
                        array_push($key,$new_arr[0]);
                        array_push($value,$new_arr[1]);
                        // var_dump($new_arr); 
                    }
                }catch(Exception $e){
                    // echo $e->getMessage();
                    continue;
                }
        }

        try{
            // var_dump($value);
            
            $list = array_combine($key,$value);
            // var_dump($list); 
            
            $url = $list['Page URL'];
            $e_url = explode('?',$url);
            $child = explode('&',$e_url[1]);
            $url_key = ['raw_message','url'];
            $url_value = [];
            array_push($url_value,$strs,$list["Page URL"]);
            foreach($child as $value){
                $new_value = explode('=',$value);
                array_push($url_key,$new_value[0]);
                array_push($url_value,$new_value[1]);
            }
            $url_json = array_combine($url_key,$url_value);
            // var_dump($url_json);
            

            
            return new Ask([
                        'message_name' => $message_name,
                        'message' => $list['Message'],
                        'sent_from' => $list['Name'],
                        'sent_to' => $sent_to,
                        'location' => geoip($list["Remote IP"])->country.'-'.geoip($list["Remote IP"])->city,
                        'date_time' => date('Y年m月d日',strtotime($list["Date"])).' '.$list["Time"],
                        'source' => '未知',
                        'message_info' => $url_json,
                        'site_id' => Admin::user()->id,
                    ]);
        }catch(Exception $e){
            // continue;
        }
        
          
        // return '成功';
    }
}
