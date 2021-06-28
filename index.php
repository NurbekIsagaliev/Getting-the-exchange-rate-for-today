<?php

function trend($current, $previous) {
    if ($current > $previous) return ' ▲ '.number_format(($current - $previous),4);
    if ($current < $previous) return ' ▼ '.number_format(($previous - $current),4);
    return '';
  }

function CBR_XML_Daily_Ru() {
    static $rates;
    
    if ($rates === null) {
        $rates = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'));
    }
    
    return $rates;
}

$data = CBR_XML_Daily_Ru();

echo "Обменный курс USD по ЦБ РФ на сегодня: 1\$ = {$data->Valute->USD->Value}₽\n".trend($data->Valute->USD->Value, $data->Valute->USD->Previous);
echo "<br/>Обменный курс Евро по ЦБ РФ на сегодня: 1€ = {$data->Valute->EUR->Value}₽\n".trend($data->Valute->EUR->Value, $data->Valute->EUR->Previous);

?>
