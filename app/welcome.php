<?php
session_start();
//var_dump($_SESSION);
?>

<!DOCTYPE html>
<html>
<head>
        <title>Welcome</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<?php include 'partials/nav.php'?>


<link rel="stylesheet" type="text/css" href="style2.css">


</div>



</body>
</html>




<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$stockSymbols = "AMZN,NIO,AMC,GME";
$allStocks = explode(",",$stockSymbols);
function getStockData($symbol){
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => "https://apidojo-yahoo-finance-v1.p.rapidapi.com/stock/v2/get-summary?symbol=$symbol&region=US",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com",
			"x-rapidapi-key: e3fcd64298mshda39a1863b41d2cp1f7c9ejsn952489d518d7"
		],
	]);
	return json_decode(curl_exec($curl),true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stocks</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    ::-webkit-scrollbar {width: 10px;}::-webkit-scrollbar-track {background: #f1f1f1;}::-webkit-scrollbar-thumb {background: #888; }::-webkit-scrollbar-thumb:hover {background: #555; }.footer {position: relative;left: 0;bottom: 0;width: 100%;text-align: center;}.select2-container .select2-search--inline .select2-search__field {line-height: 100%;}.card-header{background-color:#333;color:#fff;}
  </style></head>
<body>
  <div class="container">
<h3 class="text-center mt-2">Hello <?=$_SESSION['user']->email?> you are successfully Logged in</h3>
    <div class="mt-4 mb-4 card shadow">
			<div class="card-header"><h3 class="h3 text-center">Stocks Data</h3></div>
			<div class="row m-0">
				<div class="accordion mt-2 mb-2" id="accordionExample">
					<?php
						$symbolData = getStockData($allStocks[0]);
						$symbSummary = $symbolData["summaryProfile"]["longBusinessSummary"];
						$symbCurrPrice = $symbolData["price"]["regularMarketPrice"]["fmt"];
						$symbExchange = $symbolData["price"]["regularMarketChange"]["fmt"];
						$symbPercentChange = $symbolData["price"]["regularMarketChangePercent"]["fmt"];
						$symbPrevious = $symbolData["price"]["regularMarketPreviousClose"]["fmt"];
						$symbOpen = $symbolData["price"]["regularMarketOpen"]["fmt"];
						$symbBid = $symbolData["summaryDetail"]["bid"]["fmt"]." x ".$symbolData["summaryDetail"]["bidSize"]["raw"];
						$symbAsk = $symbolData["summaryDetail"]["ask"]["fmt"]." x ".$symbolData["summaryDetail"]["askSize"]["raw"];
						$symbDaysRange = $symbolData["summaryDetail"]["dayLow"]["fmt"]." - ".$symbolData["summaryDetail"]["dayHigh"]["fmt"];
						$symb52Range = $symbolData["summaryDetail"]["fiftyTwoWeekLow"]["fmt"]." - ".$symbolData["summaryDetail"]["fiftyTwoWeekHigh"]["fmt"];
						$symbVol = $symbolData["price"]["regularMarketVolume"]["longFmt"];
						$symbAvgVol = $symbolData["summaryDetail"]["averageVolume"]["longFmt"];
						$symbMarketCap = $symbolData["price"]["marketCap"]["fmt"];
						$symbBeta = (isset($symbolData["summaryDetail"]["beta"]["fmt"]) ? $symbolData["summaryDetail"]["beta"]["fmt"] : "N/A");
						$symbPeRatio = (isset($symbolData["summaryDetail"]["trailingPE"]["fmt"]) ? $symbolData["summaryDetail"]["trailingPE"]["fmt"] : "N/A");
						$symbEps = $symbolData["defaultKeyStatistics"]["trailingEps"]["fmt"];
						$symbEarningsDate = $symbolData["earnings"]["earningsChart"]["earningsDate"][0]["fmt"]." - ".$symbolData["earnings"]["earningsChart"]["earningsDate"][1]["fmt"];
						$symbForwardDivi = "N/A (N/A)";
						$symbExDividend = (isset($symbolData["calendarEvents"]["exDividendDate"]["fmt"]) ? $symbolData["calendarEvents"]["exDividendDate"]["fmt"] : "N/A");
						$symbTarget = $symbolData["financialData"]["targetMedianPrice"]["fmt"];
						echo '<div class="accordion-item"><h2 class="accordion-header" id="heading'.$allStocks[0].'"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$allStocks[0].'" aria-expanded="true" aria-controls="collapse'.$allStocks[0].'">'.$allStocks[0].'</button></h2><div id="collapse'.$allStocks[0].'" class="accordion-collapse collapse show" aria-labelledby="heading'.$allStocks[0].'" data-bs-parent="#accordionExample"><div class="accordion-body"> <h4 class="h4 text-center">'.$symbCurrPrice.' '.$symbExchange.' ('.$symbPercentChange.') </h4><b>Description:</b> '.$symbSummary.' <div class="row mt-4 mb-2"><div class="col-sm-6"><table class="table table-striped"><tbody><tr><td>Previous Close</td><td class="text-end fw-bold">'.$symbPrevious.'</td></tr><tr><td>Open</td><td class="text-end fw-bold">'.$symbOpen.'</td></tr><tr><td>Bid</td><td class="text-end fw-bold">'.$symbBid.'</td></tr><tr><td>Ask</td><td class="text-end fw-bold">'.$symbAsk.'</td></tr><tr><td>Days Range</td><td class="text-end fw-bold">'.$symbDaysRange.'</td></tr><tr><td>52 Week Range</td><td class="text-end fw-bold">'.$symb52Range.'</td></tr><tr><td>Volume</td><td class="text-end fw-bold">'.$symbVol.'</td></tr><tr><td>Avg. Volume</td><td class="text-end fw-bold">'.$symbAvgVol.'</td></tr></tbody></table></div><div class="col-sm-6"><table class="table table-striped"><tbody><tr><td>Market Cap</td><td class="text-end fw-bold">'.$symbMarketCap.'</td></tr><tr><td>Beta (5Y Monthly)</td><td class="text-end fw-bold">'.$symbBeta.'</td></tr><tr><td>PE Ratio (TTM)</td><td class="text-end fw-bold">'.$symbPeRatio.'</td></tr><tr><td>EPS (TTM)</td><td class="text-end fw-bold">'.$symbEps.'</td></tr><tr><td>Earnings Date</td><td class="text-end fw-bold">'.$symbEarningsDate.'</td></tr><tr><td>Forward Dividend &amp; Yield</td><td class="text-end fw-bold">'.$symbForwardDivi.'</td></tr><tr><td>Ex-Dividend Date</td><td class="text-end fw-bold">'.$symbExDividend.'</td></tr><tr><td>1y Target Est</td><td class="text-end fw-bold">'.$symbTarget.'</td></tr></tbody></table></div></div></div></div></div>';
						for($i=1;$i<count($allStocks);$i++){
							$symbol = $allStocks[$i];
							$symbolData = getStockData($allStocks[$i]);
							$symbSummary = $symbolData["summaryProfile"]["longBusinessSummary"];
							$symbCurrPrice = $symbolData["price"]["regularMarketPrice"]["fmt"];
							$symbExchange = $symbolData["price"]["regularMarketChange"]["fmt"];
							$symbPercentChange = $symbolData["price"]["regularMarketChangePercent"]["fmt"];
							$symbPrevious = $symbolData["price"]["regularMarketPreviousClose"]["fmt"];
							$symbOpen = $symbolData["price"]["regularMarketOpen"]["fmt"];
							$symbBid = $symbolData["summaryDetail"]["bid"]["fmt"]." x ".$symbolData["summaryDetail"]["bidSize"]["raw"];
							$symbAsk = $symbolData["summaryDetail"]["ask"]["fmt"]." x ".$symbolData["summaryDetail"]["askSize"]["raw"];
							$symbDaysRange = $symbolData["summaryDetail"]["dayLow"]["fmt"]." - ".$symbolData["summaryDetail"]["dayHigh"]["fmt"];
							$symb52Range = $symbolData["summaryDetail"]["fiftyTwoWeekLow"]["fmt"]." - ".$symbolData["summaryDetail"]["fiftyTwoWeekHigh"]["fmt"];
							$symbVol = $symbolData["price"]["regularMarketVolume"]["longFmt"];
							$symbAvgVol = $symbolData["summaryDetail"]["averageVolume"]["longFmt"];
							$symbMarketCap = $symbolData["price"]["marketCap"]["fmt"];
							$symbBeta = (isset($symbolData["summaryDetail"]["beta"]["fmt"]) ? $symbolData["summaryDetail"]["beta"]["fmt"] : "N/A");
							$symbPeRatio = (isset($symbolData["summaryDetail"]["trailingPE"]["fmt"]) ? $symbolData["summaryDetail"]["trailingPE"]["fmt"] : "N/A");
							$symbEps = $symbolData["defaultKeyStatistics"]["trailingEps"]["fmt"];
							$symbEarningsDate = $symbolData["earnings"]["earningsChart"]["earningsDate"][0]["fmt"]." - ".$symbolData["earnings"]["earningsChart"]["earningsDate"][1]["fmt"];
							$symbForwardDivi = "N/A (N/A)";
							$symbExDividend = (isset($symbolData["calendarEvents"]["exDividendDate"]["fmt"]) ? $symbolData["calendarEvents"]["exDividendDate"]["fmt"] : "N/A");
							$symbTarget = $symbolData["financialData"]["targetMedianPrice"]["fmt"];
							echo '<div class="accordion-item"><h2 class="accordion-header" id="heading'.$symbol.'"><button class="accordion-button collapsed" type="button"data-bs-toggle="collapse" data-bs-target="#collapse'.$symbol.'" aria-expanded="false" aria-controls="collapse'.$symbol.'">'.$symbol.'</button></h2><div id="collapse'.$symbol.'" class="accordion-collapse collapse" aria-labelledby="heading'.$symbol.'" data-bs-parent="#accordionExample"><div class="accordion-body"><h4 class="h4 text-center">'.$symbCurrPrice.' '.$symbExchange.' ('.$symbPercentChange.') </h4><b>Description:</b> '.$symbSummary.' <div class="row mt-4 mb-2"><div class="col-sm-6"><table class="table table-striped"><tbody><tr><td>Previous Close</td><td class="text-end fw-bold">'.$symbPrevious.'</td></tr><tr><td>Open</td><td class="text-end fw-bold">'.$symbOpen.'</td></tr><tr><td>Bid</td><td class="text-end fw-bold">'.$symbBid.'</td></tr><tr><td>Ask</td><td class="text-end fw-bold">'.$symbAsk.'</td></tr><tr><td>Days Range</td><td class="text-end fw-bold">'.$symbDaysRange.'</td></tr><tr><td>52 Week Range</td><td class="text-end fw-bold">'.$symb52Range.'</td></tr><tr><td>Volume</td><td class="text-end fw-bold">'.$symbVol.'</td></tr><tr><td>Avg. Volume</td><td class="text-end fw-bold">'.$symbAvgVol.'</td></tr></tbody></table></div><div class="col-sm-6"><table class="table table-striped"><tbody><tr><td>Market Cap</td><td class="text-end fw-bold">'.$symbMarketCap.'</td></tr><tr><td>Beta (5Y Monthly)</td><td class="text-end fw-bold">'.$symbBeta.'</td></tr><tr><td>PE Ratio (TTM)</td><td class="text-end fw-bold">'.$symbPeRatio.'</td></tr><tr><td>EPS (TTM)</td><td class="text-end fw-bold">'.$symbEps.'</td></tr><tr><td>Earnings Date</td><td class="text-end fw-bold">'.$symbEarningsDate.'</td></tr><tr><td>Forward Dividend &amp; Yield</td><td class="text-end fw-bold">'.$symbForwardDivi.'</td></tr><tr><td>Ex-Dividend Date</td><td class="text-end fw-bold">'.$symbExDividend.'</td></tr><tr><td>1y Target Est</td><td class="text-end fw-bold">'.$symbTarget.'</td></tr></tbody></table></div></div></div></div></div>';
						}
					?>
				</div>
			</div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
