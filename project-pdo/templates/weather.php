<?php
//禁止使用者直接使用連結進入。
if ($_SERVER['HTTP_REFERER'] == "") {
  header("Location: /");
  exit;
}
$ip = json_decode(file_get_contents("https://api.ipify.org/?format=json"), true)['ip'];
$location = json_decode(file_get_contents("https://ipinfo.io/$ip?token=2615b566f9dad9"), true)['city'];
//$location = json_decode(file_get_contents("http://ip-api.com/json/"), true)['city'];
$location = preg_replace('/\s*City$/', '', $location);  // 移除尾端可能存在的空格
$cityMap = [
    "Taipei" => "臺北市", "New Taipei" => "新北市", "Taoyuan" => "桃園市",
    "Taichung" => "臺中市", "Tainan" => "臺南市", "Kaohsiung" => "高雄市",
    "Keelung" => "基隆市", "Hsinchu" => "新竹市", "Miaoli" => "苗栗縣",
    "Changhua" => "彰化縣", "Nantou" => "南投縣", "Yunlin" => "雲林縣",
    "Chiayi" => "嘉義市", "Pingtung" => "屏東縣", "Yilan" => "宜蘭縣",
    "Hualien" => "花蓮縣", "Taitung" => "臺東縣", "Penghu" => "澎湖縣",
    "Kinmen" => "金門縣", "Lienchiang" => "連江縣"
];

$cityname = $cityMap[$location] ?? "臺北市"; // 預設值防止空白
$weather = json_decode(file_get_contents("https://opendata.cwa.gov.tw/api/v1/rest/datastore/F-C0032-001?Authorization=CWA-81F0CCD6-6045-4F97-8787-86481E9E8D95&locationName=$cityname"), true);
//echo $weather['records']['location'][0]['locationName'] . "<br>";

// foreach ($weather['records']['location'][0]['weatherElement'][0]['time'] as $index => $time) {
    // if ($index >= 3) break;
    // $icon = str_pad($time['parameter']['parameterValue'], 2, '0', STR_PAD_LEFT);
    // echo "{$time['startTime']} ~ {$time['endTime']} ";
    // echo "{$time['parameter']['parameterName']} ";
    // echo $weather['records']['location'][0]['weatherElement'][3]['time'][$index]['parameter']['parameterName'] . " ";
    // echo "<img src='https://www.cwa.gov.tw/V8/assets/img/weather_icons/weathers/svg_icon/day/$icon.svg'> ";
    // echo $weather['records']['location'][0]['weatherElement'][4]['time'][$index]['parameter']['parameterName'] . "℃<br>";
// }
//$now = strtotime(date('Y-m-d H:i:s')); // 現在時間
$now = strtotime('12:00:00');
$start = strtotime('12:00:00');  // 起始時間
$end = strtotime('18:00:00');    // 結束時間

if($now >= $start && $now <= $end)
  $status=0;
else
  $status=1;
  $icon = str_pad($weather['records']['location'][0]['weatherElement'][0]['time'][$status]['parameter']['parameterValue'], 2, '0', STR_PAD_LEFT);
// echo "{$weather['records']['location'][0]['weatherElement'][3]['time'][$status]['startTime']} ~ ";
// echo "{$weather['records']['location'][0]['weatherElement'][3]['time'][$status]['endTime']} ";
// echo $weather['records']['location'][0]['weatherElement'][3]['time'][$status]['parameter']['parameterName'] . " ";
// echo $weather['records']['location'][0]['weatherElement'][0]['time'][$status]['parameter']['parameterName'] . " ";
// echo "<img src='https://www.cwa.gov.tw/V8/assets/img/weather_icons/weathers/svg_icon/day/$icon.svg'> ";
// echo $weather['records']['location'][0]['weatherElement'][4]['time'][$status]['parameter']['parameterName'] . "℃<br>";
$City=$weather['records']['location'][0]['locationName'];
$cloud=$weather['records']['location'][0]['weatherElement'][0]['time'][$status]['parameter']['parameterName'] . " ";
$cool=$weather['records']['location'][0]['weatherElement'][3]['time'][$status]['parameter']['parameterName'] . " ";
$temperature_Max=$weather['records']['location'][0]['weatherElement'][4]['time'][$status]['parameter']['parameterName'] . "℃";
$temperature_Min=$weather['records']['location'][0]['weatherElement'][2]['time'][$status]['parameter']['parameterName'] . "℃";
$iconMapping = [
    "01" => "weather_ani_01",
    "02" => "weather_ani_07",
    "03" => "weather_ani_07",
    "04" => "weather_ani_07",
    "05" => "weather_ani_07",
    "06" => "weather_ani_07",
    "07" => "weather_ani_07",
    "19" => "weather_ani_07",
    "21" => "weather_ani_07",
    "24" => "weather_ani_07",
    "25" => "weather_ani_07",
    "26" => "weather_ani_07",
    "27" => "weather_ani_07",
    "28" => "weather_ani_07",
    "31" => "weather_ani_07",
    "32" => "weather_ani_07",
    "35" => "weather_ani_07",
    "36" => "weather_ani_07",
    "42" => "weather_ani_42"
];
$iconnai = isset($iconMapping[$icon]) ? $iconMapping[$icon] : "weather_ani_02";
?>
<div style="font-family: 'Arial', sans-serif; text-align: center; margin: 20px;">
 <h1 style="margin-bottom: 3px;font-weight:bold"><?php echo $City?><span class="h3 mx-2" style="position: relative; top: -5px;"><i class="fa-solid fa-location-dot weather_location"></span></i></h1><br>
    <div style="font-size: 18px; margin-bottom: 10px;">         
         <div style="font-size: 16px;"><?php echo $cool.$cloud?></div>
    </div>
    <div style="display: flex; justify-content: center; align-items: center;">
        <img src="https://www.cwa.gov.tw/V8/assets/img/weather_icons/weathers/svg_icon/day/<?php echo $icon ?>.svg" 
             alt="天氣圖示" width="80" style="margin-right: 10px;" class="<?php echo $iconnai ?>">
        <div style="text-align: left;">
            
            <div style="font-size: 36px; font-weight: bold;"><?php echo $temperature_Max?></div>
        </div>
    </div>
</div>
