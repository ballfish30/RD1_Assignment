<?php
require_once("config.php");

class WeatherController extends Controller {
    
    function index() {
        $data = file_get_contents("https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-50C0F9C6-79D6-4B30-B960-24D1B2964BAC");
        // var_dump($link);
    }
    
    function timer() {
        ignore_user_abort();//關閉瀏覽器後，繼續執行php程式碼
        set_time_limit(0);//程式執行時間無限制
        $sleep_time = 300;//多長時間執行一次
        $switch = 1;
        while($switch){
            $switch = 1;
            $msg=date("Y-m-d H:i:s").$switch;
                file_put_contents("log.log",$msg,FILE_APPEND);//記錄日誌
            sleep($sleep_time);//等待時間，進行下一次操作。
        }
        echo(123);
        exit();
    }
    
}

?>