<?php if(isset($_GET['input'])):
    $var= 'http://dev.markitondemand.com/MODApis/Api/v2/Lookup/json?input='.$_GET["input"];
    $temp=file_get_contents($var);
    $v=json_decode($temp);
   // $t=json_encode($temp);
    $i=0;
    foreach($v as $item)
    {
       $data[$i]="$item->Symbol - $item->Name ( $item->Exchange )";
       /* $data[i]["Name"]=$item->Name;
        $data[i]["Symbol"]=$item->Symbol;
        $data[i]["Exchange"]=$item->Exchange;*/
        $i++;
    }
   /* $z["Name"]=$v[0]->Name." ".$v[0]->Symbol." ".$v[0]->Exchange;
    $z["B"]=$v[0]->Name;
    $z["C"]=$v[0]->Name;*/
    echo json_encode($data);
   endif;
 if(isset($_GET['symbol'])):
    $a=$_GET["symbol"];
    $selectedSymbol =$_GET["symbol"];
    $quote='http://dev.markitondemand.com/MODApis/Api/v2/Quote/json?symbol='.$selectedSymbol;
    $tempData=file_get_contents($quote);
    $decodeData=json_decode($tempData);

    $quoteData["Status"]=$decodeData->Status;
    $quoteData["Name"]=$decodeData->Name;
    $quoteData["Symbol"]=$decodeData->Symbol;
    $quoteData["LastPrice"]=$decodeData->LastPrice;
    $quoteData["Change"]=$decodeData->Change;
    $quoteData["TimeStamp"]=$decodeData->Timestamp;
    $quoteData["ChangePercent"]=$decodeData->ChangePercent;
    $quoteData["MSDate"]=$decodeData->MSDate;
    $quoteData["MarketCap"]=$decodeData->MarketCap;
    $quoteData["Volume"]=$decodeData->Volume;
    $quoteData["ChangeYTD"]=$decodeData->ChangeYTD;
    $quoteData["ChangePercentYTD"]=$decodeData->ChangePercentYTD;
    $quoteData["High"]=$decodeData->High;
    $quoteData["Low"]=$decodeData->Low;
    $quoteData["Open"]=$decodeData->Open;
    
    
    
    echo json_encode($quoteData);
elseif(isset($_GET['parameters'])):
    $jsonParam=json_encode($_GET['parameters']);
    $link='http://dev.markitondemand.com/MODApis/Api/v2/InteractiveChart/json?parameters='.$jsonParam;
  /*  $link='http://dev.markitondemand.com/MODApis/Api/v2/InteractiveChart/json?parameters='.$_GET['parameters'];*/
    $linkdata=file_get_contents($link);
    echo json_encode($linkdata);

//echo ($_GET['parameters']);
    
endif;

if(isset($_GET['sym'])):

$searchSym=$_GET['sym'];
$url ='https://api.datamarket.azure.com/Bing/Search/v1/News?Query=%27'.$searchSym.'%27&$format=json';
$username='mr5zBnLMuV4qvsXmjRSjc/lGFZbGCS47nkF7RDQBO3g';
$password='mr5zBnLMuV4qvsXmjRSjc/lGFZbGCS47nkF7RDQBO3g';
/*$context = stream_context_create(array(
    'http' => array(
        'request_fulluri' => true,
        'header'  => "Authorization: Basic " . base64_encode("$username:$password")
    )
));
$searchData = file_get_contents($url, false, $context);
echo json_encode($searchData);*/
$w = stream_get_wrappers();
echo 'openssl: ',  extension_loaded  ('openssl') ? 'yes':'no', "\n";
echo 'http wrapper: ', in_array('http', $w) ? 'yes':'no', "\n";
echo 'https wrapper: ', in_array('https', $w) ? 'yes':'no', "\n";
echo 'wrappers: ', var_dump($w);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
echo json_encode($output);

endif;

?>