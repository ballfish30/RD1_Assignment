<?php

class WeatherController extends Controller
{

    function index()
    {
        $this->view("Weather/index");
    }


    // 伺服器每隔６００秒更新一次資料庫
    function timer()
    {
        ignore_user_abort(); //關閉瀏覽器後，繼續執行php程式碼
        set_time_limit(0); //程式執行時間無限制
        $sleep_time = 300; //多長時間執行一次
        $switch = 1;
        while ($switch) {
            $switch = 1;
            $msg = date("Y-m-d H:i:s") . $switch;
            file_put_contents("log.log", $this->weatherData(), FILE_APPEND); //記錄日誌
            $this->weatherData();
            $this->rainfallNowData();
            $this->rainfall24hrData();
            sleep($sleep_time); //等待時間，進行下一次操作。
        }
        exit();
    }


    // 天氣預報
    function weatherData()
    {
        // 取得未來一週天氣預報
        $data = json_decode(file_get_contents("https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-50C0F9C6-79D6-4B30-B960-24D1B2964BAC&format=JSON"), true);
        // 資料庫連線參數
        $link = include 'config.php';
        $i = count($data['records']['locations'][0]['location']);
        // 儲存各縣市天氣預報相關資料
        foreach ($data['records']['locations'][0]['location'] as $value) {
            $locationName = $value['locationName'];
            $lat = $value['lat'];
            $lon = $value['lon'];
            for ($j = 0; $j < 14; $j++) {
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
                foreach ($value['weatherElement'] as $weatherElement) {
                    // var_dump($weatherElement['time'][$j]['elementValue'][0]['value']);
                    $startDatetime = $weatherElement['time'][$j]['startTime'];
                    $endDatetime = $weatherElement['time'][$j]['endTime'];
                    if ($weatherElement['description'] == "12小時降雨機率") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $pop = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $pop = '0';
                        }
                    } elseif ($weatherElement['description'] == "平均溫度") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $t = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $t = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "平均相對濕度") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $RH = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $RH = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "最小舒適度指數") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $MinCI = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $MinCI = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "最大風速") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $WS = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $WS = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "最高體感溫度") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $MaxAT = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $MaxAT = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "天氣現象") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $Wx = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $Wx = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "最大舒適度指數") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $MaxCI = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $MaxCI = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "最低溫度") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $MinT = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $MinT = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "紫外線指數") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != "") {
                            $UVI = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $UVI = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "天氣預報綜合描述") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $weatherDescription = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $weatherDescription = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "最低體感溫度") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $MinAT = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $MinAT = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "最高溫度") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $MaxT = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $MaxT = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "風向") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $WD = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $WD = 'NULL';
                        }
                    } elseif ($weatherElement['description'] == "平均露點溫度") {
                        if ($weatherElement['time'][$j]['elementValue'][0]['value'] != " ") {
                            $Td = $weatherElement['time'][$j]['elementValue'][0]['value'];
                        } else {
                            $Td = 'NULL';
                        }
                    }
                }
                $sql = <<<mutil
                select * from weather where locationName = "$locationName" and startDatetime = "$startDatetime";
                mutil;
                $result = mysqli_query($link, $sql);
                $search = mysqli_fetch_assoc($result);
                //判斷是否查詢到該筆資料，如有將進行更新資料或新增資料
                if ($search == NULL) {
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
                } else {
                    $sql = <<<mutil
                    update weather
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
                    mysqli_query($link, $sql);
                }
            }
        }
        return ("已更新囉\n");
    }


    // 過去一小時累計雨量
    function rainfallNowData()
    {
        // 資料庫連線參數
        $link = include 'config.php';
        // 取得過去一小時雨量資料
        $data = json_decode(file_get_contents('https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0002-001?Authorization=CWB-50C0F9C6-79D6-4B30-B960-24D1B2964BAC&elementName=NOW&parameterName=ATTRIBUTE'));
        foreach ($data->records->location as $value) {
            $lat = $value->lat;
            $lon = $value->lon;
            $locationName = $value->locationName;
            $stationId = $value->stationId;
            $elementValue = $value->weatherElement[0]->elementValue;
            $sql = <<<mutil
                select * from rainfallNow where stationId = "$stationId";
                mutil;
            $result = mysqli_query($link, $sql);
            $search = mysqli_fetch_assoc($result);
            //判斷是否查詢到該筆資料，如有將進行更新資料或新增資料
            if ($search == NULL) {
                $sql = <<<mutil
                insert into rainfallNow(
                    lat, lon, locationName,
                    stationId, elementValue
                )values(
                    $lat, $lon, "$locationName", "$stationId", $elementValue
                );
                mutil;
                mysqli_query($link, $sql);
            } else {
                $sql = <<<mutil
                    update rainfallNow
                    set
                        lat = $lat,
                        lon = $lon,
                        elementValue = $elementValue
                    where
                        stationId = '$stationId';
                    mutil;
                mysqli_query($link, $sql);
            }
        }
    }



    // 過去二十四小時累計雨量
    function rainfall24hrData()
    {
        $link = include 'config.php';
        $data = json_decode(file_get_contents('https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0002-001?Authorization=CWB-50C0F9C6-79D6-4B30-B960-24D1B2964BAC&elementName=HOUR_24&parameterName=ATTRIBUTE'));
        foreach ($data->records->location as $value) {
            $lat = $value->lat;
            $lon = $value->lon;
            $locationName = $value->locationName;
            $stationId = $value->stationId;
            $elementValue = $value->weatherElement[0]->elementValue;
            $sql = <<<mutil
                select * from rainfall24hr where stationId = "$stationId";
                mutil;
            $result = mysqli_query($link, $sql);
            $search = mysqli_fetch_assoc($result);
            //判斷是否查詢到該筆資料，如有將進行更新資料或新增資料
            if ($search == NULL) {
                $sql = <<<mutil
                insert into rainfall24hr(
                    lat, lon, locationName,
                    stationId, elementValue
                )values(
                    $lat, $lon, "$locationName", "$stationId", $elementValue
                );
                mutil;
                mysqli_query($link, $sql);
            } else {
                echo(1);
                $sql = <<<mutil
                    update rainfall24hr
                    set
                        lat = $lat,
                        lon = $lon,
                        elementValue = $elementValue
                    where
                        stationId = '$stationId';
                    mutil;
                mysqli_query($link, $sql);
            }
        }
    }



    function todayWeather()
    {
        $locationName = $_GET['locationName'];
        $link = include 'config.php';
        $arr = array();
        $startTime = date("Y-m-d H:i:s", mktime(6, 00, 00, date('m'), date('d'), date('Y')));
        $endTime = date("Y-m-d H:i:s", mktime(18, 00, 00, date('m'), date('d'), date('Y')));
        $datetime = date("Y-m-d H:i:s", mktime(date('H') + 8, date('i'), date('s'), date('m'), date('d'), date('Y')));
        if ($datetime >= date("Y-m-d H:i:s", mktime(6, 00, 00, date('m'), date('d'), date('Y'))) and $datetime < date("Y-m-d H:i:s", mktime(18, 00, 00, date('m'), date('d'), date('Y')))) {
            $news = <<<multi
            select * from weather where (startDatetime = '$startTime') and locationName = '$locationName'  order by startDatetime;
            multi;
        }else{
            $news = <<<multi
            select * from weather where (startDatetime = '$endTime') and locationName = '$locationName'  order by startDatetime;
            multi;
        }
        $result = mysqli_query($link, $news);
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json編碼 
    }



    function tomorrowWeather(){
        $locationName = $_GET['locationName'];
        $link = include 'config.php';
        $arr = array();
        $today = date("Y/m/d");
        $tomorrow = date('Y/m/d',strtotime('+2 day'));
        $news = <<<multi
        select * from weather where (DATE_FORMAT(startDatetime, "%Y/%m/%d") between '$today' and '$tomorrow') and locationName = '$locationName' order by startDatetime;
        multi;
        $result = mysqli_query($link, $news);
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json編碼 
    }



    function weekWeather(){
        $locationName = $_GET['locationName'];
        $link = include 'config.php';
        $arr = array();
        $today = date("Y/m/d");
        $tomorrow = date('Y/m/d',strtotime('+7 day'));
        $news = <<<multi
        select * from weather where (DATE_FORMAT(startDatetime, "%Y/%m/%d") between '$today' and '$tomorrow') and locationName = '$locationName' order by startDatetime;
        multi;
        $result = mysqli_query($link, $news);
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json編碼 
    }


    function rainfallNow(){
        $stationID = $_GET['stationID'];
        $link = include 'config.php';
        $arr = array();
        $news = <<<multi
        select * from rainfallNow where stationID = '$stationID';
        multi;
        $result = mysqli_query($link, $news);
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json編碼
    }



    function rainfall24hr(){
        $stationID = $_GET['stationID'];
        $link = include 'config.php';
        $arr = array();
        $news = <<<multi
        select * from rainfall24hr where stationID = '$stationID';
        multi;
        $result = mysqli_query($link, $news);
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row);
        }
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);//json編碼
    }
}
