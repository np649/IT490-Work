<!DOCTYPE html>
<html>
<head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<?php include 'partials/nav.php'?>

       







<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$curl = curl_init();
curl_setopt_array($curl, [
        CURLOPT_URL => "https://apidojo-yahoo-finance-v1.p.rapidapi.com/news/v2/list?region=US&snippetCount=28",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "ok",
        CURLOPT_HTTPHEADER => [
                "content-type: text/plain",
                "x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com",
                "x-rapidapi-key: 1dee1ba229msh25be05be877d709p167a2cjsn4c229d50d829"
        ],
]);
$response = curl_exec($curl);
$body = json_decode($response,true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>News Homepage</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    ::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background: #f1f1f1;}::-webkit-scrollbar-thumb {background: #888; }::-webkit-scrollbar-thumb:hover {background: #555; }.footer {position: relative;left: 0;bottom: 0;width: 100%;text-align: center;}.select2-container .select2-search--inline .select2-search__field {line-height: 100%;}.card-header{background-color:#333;color:#fff;}
  </style></head>
<body>
  <div class="container">
    <div class="mt-4 mb-4 card shadow">
<div class="card-header"><h1 class="h3 text-center">Yahoo Finance News</h1></div>
                        <div class="row m-0">
                                <?php
                                        for($i=0;$i<count($body['data']['main']['stream']);$i++){
                                                $streamData = $body['data']['main']['stream'][$i]['content'];
                                                $imageUrl = "https://dummyimage.com/250x250/000/fff.png&text=No+Image";
                                                if(isset($streamData['thumbnail']['resolutions'][0]['url']))
                                                        $imageUrl = $streamData['thumbnail']['resolutions'][0]['url'];
                                                $date = explode("T",$streamData['pubDate']);
                                                $date = $date[0];
                                                $provider = $streamData['provider']['displayName'];
                                                $titleData = $streamData['title'];
                                                if(isset($streamData['clickThroughUrl']['url']))
                                                        $titleData = "<a href='".$streamData['clickThroughUrl']['url']."' target='_blank'>".$streamData['title']."</a>";
                                                echo "<div class='col-sm-3 text-center h4 p-2'><img src='".$imageUrl."' height=250 width=250 style='border-radius:5px'></div>
                                                <div class='col-sm-9 h4 p-2'><small class='text-secondary h6'>$provider • $date</small><br/>$titleData</div>";
                                        }
                                ?>
                        </div>
    </div>
  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
