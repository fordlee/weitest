<?php
function constellationNO($month, $day) {
    // 检查参数有效性 
    if ($month < 1 || $month > 12 || $day < 1 || $day > 31) return false;
    /*星座名称以及开始日期
    1白羊座[Aries](3.21-4.19)
    2金牛座[Taurus](4.20-5.20)
    3双子座[Gemini](5.21-6.21)
    4巨蟹座[Cancer](6.22-7.22)
    5狮子座[Leo](7.23-8.22)
    6处女座[Virgo](8.23-9.22)
    7天秤座[Libra](9.23-10.23)
    8天蝎座[Scorpius](10.24-11.22)
    9射手座[Sagittarius](11.23-12.21)
    10摩羯座[Capricorn](12.22-1.19)
    11水瓶座[Aquarius](1.20-2.18)
    12双鱼座[Pisces](2.19-3.20)*/

    $constellations = array(
        array( "20" => 11),
        array( "19" => 12),
        array( "21" => 1),
        array( "20" => 2),
        array( "21" => 3),
        array( "22" => 4),
        array( "23" => 5),
        array( "23" => 6),
        array( "23" => 7),
        array( "24" => 8),
        array( "23" => 9),
        array( "22" => 10)
    );
    list($constellation_start, $constellation_no) = each($constellations[(int)$month-1]);
    if ($day < $constellation_start) list($constellation_start, $constellation_no) = each($constellations[($month -2 < 0) ? $month = 11: $month -= 2]);
    
    return $constellation_no;
}

function ConstellationName($month, $day, $language) {
    // 检查参数有效性 
    if ($month < 1 || $month > 12 || $day < 1 || $day > 31) return false;
    switch ($language) {
        case 'zh':
            // 星座名称以及开始日期
            $constellations = array(
                array( "20" => "水瓶座"),
                array( "19" => "双鱼座"),
                array( "21" => "白羊座"),
                array( "20" => "金牛座"),
                array( "21" => "双子座"),
                array( "22" => "巨蟹座"),
                array( "23" => "狮子座"),
                array( "23" => "处女座"),
                array( "23" => "天秤座"),
                array( "24" => "天蝎座"),
                array( "23" => "射手座"),
                array( "22" => "摩羯座")
            );
            break;
        case 'en':
            $constellations = array(
                array( "20" => "Aquarius"),
                array( "19" => "Pisces"),
                array( "21" => "Aries"),
                array( "20" => "Taurus"),
                array( "21" => "Gemini"),
                array( "22" => "Cancer"),
                array( "23" => "Leo"),
                array( "23" => "Virgo"),
                array( "23" => "Libra"),
                array( "24" => "Scorpius"),
                array( "23" => "Sagittarius"),
                array( "22" => "Capricorn")
            );
            break;
        default:
            $constellations = array(
                array( "20" => "Aquarius"),
                array( "19" => "Pisces"),
                array( "21" => "Aries"),
                array( "20" => "Taurus"),
                array( "21" => "Gemini"),
                array( "22" => "Cancer"),
                array( "23" => "Leo"),
                array( "23" => "Virgo"),
                array( "23" => "Libra"),
                array( "24" => "Scorpius"),
                array( "23" => "Sagittarius"),
                array( "22" => "Capricorn")
            );
            break;
    }

    list($constellation_start, $constellation_name) = each($constellations[(int)$month-1]);

    if ($day < $constellation_start) list($constellation_start, $constellation_name) = each($constellations[($month -2 < 0) ? $month = 11: $month -= 2]);

    return $constellation_name;
}

function getConstellation($birthdate){
    $birthdayM = date("m",strtotime($birthdate));
    $birthdayD = date("d",strtotime($birthdate));
    $constellation_no = constellationNO($birthdayM,$birthdayD);

    return $constellation_no;
}

function getConstellationName($birthdate,$language){
    $birthdayM = date("m",strtotime($birthdate));
    $birthdayD = date("d",strtotime($birthdate));
    $constellation_name = ConstellationName($birthdayM,$birthdayD,$language);

    return $constellation_name;
}

function getCharacter($birthdate,$language){
    $constellation_no = getConstellation($birthdate);
    $str = file_get_contents(UPLOADS_PATH.'/local/27/'.$language.'/'.$constellation_no.".txt");
    $arr = explode("|", $str);
    $number = rand(0,count($arr));
    
    return $arr[$number];
} 


?>