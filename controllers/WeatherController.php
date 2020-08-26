<?php
require_once("config.php");

class WeatherController extends Controller {
    
    function index() {
        echo(123);
    }
    

    // 伺服器每隔６００秒更新一次資料庫
    function timer() {
        ignore_user_abort();//關閉瀏覽器後，繼續執行php程式碼
        set_time_limit(0);//程式執行時間無限制
        $sleep_time = 300;//多長時間執行一次
        $switch = 1;
        while($switch){
            $switch = 1;
            $msg=date("Y-m-d H:i:s").$switch;
            file_put_contents("log.log",$this->index(),FILE_APPEND);//記錄日誌
            $this->index();
            sleep($sleep_time);//等待時間，進行下一次操作。
        }
        exit();
    }



    function weatherData(){
        // 取得未來一週天氣預報
        $data = json_decode(file_get_contents("https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-50C0F9C6-79D6-4B30-B960-24D1B2964BAC&format=JSON"), true);
        // 資料庫連線參數
        $link = include 'config.php';
        $i = count($data['records']['locations'][0]['location']);
        // 每個縣市資料迴圈
        foreach($data['records']['locations'][0]['location'] as $value ){
            $locationName = $value['locationName'];
            $lat = $value['lat'];
            $lon = $value['lon'];
            for($j=0; $j<14; $j++){
                $startDatetime;
                $endDatetime;
                $pop;
                $t;
                $RH;
                $MinCI;
                $WS;
                $MaxAT;
                $Wx;
                $MaxCI;
                $MinT;
                $UVI;
                $weatherDescription;
                $MinAT;
                $MaxT;
                $WD;
                $Td;
                foreach($value['weatherElement'] as $weatherElement){
                    // var_dump($weatherElement['time'][$j]['elementValue'][0]['value']);
                    $startDatetime = $weatherElement['time'][$j]['startTime'];
                    $endDatetime = $weatherElement['time'][$j]['endTime'];
                    if($weatherElement['description']=="12小時降雨機率"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $pop = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $pop = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="平均溫度"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $t = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $t = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="平均相對濕度"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $RH = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $RH = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="最小舒適度指數"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $MinCI = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $MinCI = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="最大風速"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $WS = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $WS = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="最高體感溫度"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $MaxAT = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $MaxAT = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="天氣現象"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $Wx = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $Wx = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="最大舒適度指數"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $MaxCI = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $MaxCI = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="最低溫度"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $MinT = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $MinT = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="紫外線指數"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != ""){
                            $UVI = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $UVI = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="天氣預報綜合描述"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $weatherDescription = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $weatherDescription = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="最低體感溫度"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $MinAT = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $MinAT = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="最高溫度"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $MaxT = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $MaxT = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="風向"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $WD = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $WD = 'NULL';
                        }
                    }
                    elseif($weatherElement['description']=="平均露點溫度"){
                        if($weatherElement['time'][$j]['elementValue'][0]['value'] != " "){
                            $Td = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        }
                        else{
                            $Td = 'NULL';
                        }
                    }
                }
                $sql = <<<mutil
                select * from weather where locationName = "$locationName" and startDatetime = "$startDatetime";
                mutil;
                $result = mysqli_query($link, $sql);
                $search = mysqli_fetch_assoc($result);
                if($search == NULL){
                    $sql = <<<mutil
                    INSERT  into weather(
                        locationName, lat, lon, startDatetime,
                        endDatetime, pop, t, RH, MinCI, WS,
                        MaxAT, Wx, MaxCI, MinT, UVI, weatherDescription,
                        MinAT, MaxT, WD, Td
                    )values("$locationName", $lat, $lon, "$startDatetime",
                    "$endDatetime", $pop, $t, $RH, $MinCI, $WS,
                    $MaxAT, "$Wx", $MaxCI, $MinT, $UVI, "$weatherDescription",
                    $MinAT, $MaxT, "$WD", $Td);
                    mutil;
                    mysqli_query($link, $sql);
                }
                else{
                    $sql = <<<mutil
                    upadte weather
                    set
                        locationName = "$locationName",
                        lat = $lat,
                        lon = $lon,
                        startDatetime = "$startDatetime",
                        endDatetime = "$endDatetime",
                        pop = $pop,
                        t = $t,
                        RH = $RH,
                        MinCI = $MinCI,
                        WS = $WS,
                        MaxAT = $MaxAT,
                        Wx = "$Wx",
                        MaxCI = $MaxCI,
                        MinT = $MinT,
                        UVI = $UVI,
                        weatherDescription = "$weatherDescription",
                        MinAT = $MinAT,
                        MaxT = $MaxT,
                        WD = "$WD",
                        Td = $Td
                    where
                        locationName = "$locationName" and startDatetime = "$startDatetime";
                    mutil;
                }
            }
        }
        
        return ($data);
    }
    
}

?>