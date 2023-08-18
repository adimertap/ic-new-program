<?php
/**
 * Author  		: Hamzah
 * Email 		: if.hamzah93@gmail.com
 * Since       	: Version 1.2 Modified
 * Dilarang merubah apapun tanpa sepengetahuan pembuat
 */

if (!function_exists('get_indo_bulan')) {
	/**
	 * Fungsi untuk mendapatkan bulan dengan nama indonesia
	 *
	 * @param  string $bln
	 * @return string
	 */
	function get_indo_bulan($bln = '')
	{
		$data = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		if (empty($bln)) {
			return $data;
		} else {
			$bln = (int)$bln;
			return $data[$bln];
		}
	}
}
 
if (!function_exists('get_indo_bln')) {
 
	/**
	 * Fungsi untuk mendapatkan bulan dengan nama indonesia
	 *
	 * @param  string $bln
	 * @return string
	 */
	function get_indo_bln($bln = '')
	{
		$data = array(1 => 'JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGT', 'SEP', 'OKT', 'NOV', 'DES');
		if (empty($bln)) {
			return $data;
		} else {
			$bln = (int)$bln;
			return $data[$bln];
		}
	}
}

if (!function_exists('get_indo_hari')) {
	/**
	 * Fungsi untuk mendapatkan nama hari indonesia
	 *
	 * @param  string $hari
	 * @return string
	 */
	function get_indo_hari($hari = '')
	{
		$data = array(1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu');
		if (empty($hari)) {
			return $data;
		} else {
			$hari = (int)$hari;
			return $data[$hari];
		}
	}
}

if (!function_exists('tgl_indo')) {
	/**
	 * Method untuk memformat tanggal ke indonesia
	 *
	 * @param  string $tgl
	 * @return string
	 */
	function tgl_indo($tgl = '')
	{
		if (!empty($tgl)) {
			$pisah = explode('-', $tgl);
			return $pisah[2].' '.get_indo_bulan($pisah[1]).' '.$pisah[0];
		}
	}
}

if (!function_exists('tgl_indo2')) {
	/**
	 * Method untuk memformat tanggal ke indonesia
	 *
	 * @param  string $tgl
	 * @return string
	 */
	function tgl_indo2($tgl = '')
	{
		if (!empty($tgl)) {
			$pisah = explode('-', $tgl);
			return $pisah[2].' '.get_indo_bln($pisah[1]).' '.$pisah[0];
		}
	}
}

if (!function_exists('tgl_jam_indo')) {
	/**
	 * Method untuk memformat tanggal dan jam ke format indonesia
	 *
	 * @param  string $tgl_jam
	 * @return string
	 */
	function tgl_jam_indo($tgl_jam = '')
	{
		if (!empty($tgl_jam)) {
			$pisah = explode(' ', $tgl_jam);
			return tgl_indo($pisah[0]).' '.date('H:i:s', strtotime($tgl_jam));
		}
	}
}

if (!function_exists('tgl_jam_menit')) {
	/**
	 * Method untuk memformat tanggal dan jam ke format indonesia
	 *
	 * @param  string $tgl_jam
	 * @return string
	 */
	function tgl_jam_menit($tgl_jam = '')
	{
		if (!empty($tgl_jam)) {
			$pisah = explode(' ', $tgl_jam);
			return tgl_indo($pisah[0]).', '.date('H:i', strtotime($tgl_jam)).' WIB';
		}
	}
}

if (!function_exists('get_post_data')) {
	/**
	 * Metho untuk mendapatkan array post
	 *
	 * @param  string $key
	 * @return string
	 */
	function get_post_data($key = '')
	{
		if (isset($_POST[$key])) {
			return $_POST[$key];
		}

		return;
	}
}

if (!function_exists('get_abjad')) {
	/**
	 * Method untuk mendapatkan huruf berdasarkan nomornya
	 *
	 * @param  integer $index
	 * @return string
	 */
	function get_abjad($index)
	{
		$sa = "";
		while ($index >= 0) {
			$sa = chr($index % 26 + 65) . $sa;
			$index = floor($index / 26) - 1;
		}
		return $sa;
	}
}

if (!function_exists('roman2number')) {
	/**
	 * Method untuk mendapatkan huruf berdasarkan nomornya
	 *
	 * @param  integer $index
	 * @return string
	 */
	function roman2number($roman){
		$conv = array(
			array("letter" => 'I', "number" => 1),
			array("letter" => 'V', "number" => 5),
			array("letter" => 'X', "number" => 10),
			array("letter" => 'L', "number" => 50),
			array("letter" => 'C', "number" => 100),
			array("letter" => 'D', "number" => 500),
			array("letter" => 'M', "number" => 1000),
			array("letter" => 0, "number" => 0)
		);
		$arabic = 0;
		$state = 0;
		$sidx = 0;
		$len = strlen($roman);

		while ($len >= 0) {
			$i = 0;
			$sidx = $len;

			while ($conv[$i]['number'] > 0) {
				if (strtoupper(@$roman[$sidx]) == $conv[$i]['letter']) {
					if ($state > $conv[$i]['number']) {
						$arabic -= $conv[$i]['number'];
					} else {
						$arabic += $conv[$i]['number'];
						$state = $conv[$i]['number'];
					}
				}
				$i++;
			}

			$len--;
		}

		return($arabic);
	}
}

if (!function_exists('number2roman')) {
	function number2roman($num,$isUpper=true) {
		$n = intval($num);
		$res = '';

		/*** roman_numerals array ***/
		$roman_numerals = array(
			'M' => 1000,
			'CM' => 900,
			'D' => 500,
			'CD' => 400,
			'C' => 100,
			'XC' => 90,
			'L' => 50,
			'XL' => 40,
			'X' => 10,
			'IX' => 9,
			'V' => 5,
			'IV' => 4,
			'I' => 1
		);

		foreach ($roman_numerals as $roman => $number)
		{
			/*** divide to get matches ***/
			$matches = intval($n / $number);

			/*** assign the roman char * $matches ***/
			$res .= str_repeat($roman, $matches);

			/*** substract from the number ***/
			$n = $n % $number;
		}

		/*** return the res ***/
		if($isUpper) return $res;
		else return strtolower($res);
	}
}

if (!function_exists('enurl_redirect')) {
	/**
	 * Method untuk enkripsi url
	 *
	 * @param  string $current_url
	 * @return string
	 */
	function enurl_redirect($current_url)
	{
		return str_replace(array("%2F","%5C"), array("%252F","%255C"), urlencode($current_url));
	}
}

if (!function_exists('deurl_redirect')) {
	/**
	 * Method untuk deskripsi url
	 *
	 * @param  string $url
	 * @return string
	 */
	function deurl_redirect($url)
	{
		return urldecode(urldecode($url));
	}
}

if (!function_exists('pr')) {
	function pr($array) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
}

if (!function_exists('start_native_session')) {
	/**
	 * Method untuk mengaktifkan natif session
	 * http://stackoverflow.com/questions/6249707/check-if-php-session-has-already-started
	 */
	function start_native_session()
	{
		if (session_id() == '') {
			session_start();
		}
	}
}

if (!function_exists('get_ip')) {
	/**
	 * Method untuk mendapatkan ip pengakses
	 * @return string
	 */
	function get_ip()
	{
		return $_SERVER['REMOTE_ADDR'];
	}
}

if (!function_exists('get_email_from_string')) {
	/**
	 * Method untuk mendapatkan email dari string
	 *
	 * @param  string $str
	 * @return array
	 */
	function get_email_from_string($str)
	{
		$pattern = '/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,4}\b/i';

		preg_match_all($pattern, $str, $results);

		return $results[0];
	}
}

if (!function_exists('get_url_data')) {
	/**
	 * Method untuk mendapatkan data dari url
	 *
	 * @param  string $url
	 * @return string body
	 */
	function get_url_data($url)
	{
		# jika curl hidup
		if (function_exists('curl_version')) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			$response    = curl_exec($ch);
			$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			$header      = substr($response, 0, $header_size);
			$body        = substr($response, $header_size);
			$code        = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
		} else {
			$body = file_get_contents($url);
		}

		return $body;
	}
}

if (!function_exists('slug')) {
	function slug($str) {
		$str = strtolower(trim($str));
		$str = preg_replace('/[^a-z0-9-]/', '-', $str);
		$str = preg_replace('/-+/', "-", $str);
		return rtrim($str, '-');
	}
}

if (!function_exists('indo_hari')) {
	/* hari indonesia */
	function indo_hari($hari = '') {
		$day = date('D', strtotime($hari));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}
}

if (!function_exists('ing_hari')) {
	/* hari english */
	function ing_hari($hari = '') {
		$day = date('l', strtotime($hari));
		return $day;
	}
}

if (!function_exists('indo_time')) {
	/* fungsi jam am atau pm */
	function indo_time($time = '') {
		$jam = date("H:i", strtotime($time));
		return $jam;
	}
}

if (!function_exists('eng_tgl')) {
	/* fungsi tanggal english */
	function eng_tgl($tgl = '') {
		$tgl_eng = date('F jS, Y', strtotime($tgl));
		return $tgl_eng;
	}
}

if (!function_exists('format_datetime')) {
	function format_datetime($datetime)
	{
		# format tanggal, jika hari ini
		if (date('Y-m-d') == date('Y-m-d', strtotime($datetime))) {
			$selisih = time() - strtotime($datetime) ;

			$detik = $selisih ;
			$menit = round($selisih / 60);
			$jam   = round($selisih / 3600);

			if ($detik <= 60) {
				if ($detik == 0) {
					$waktu = "baru saja";
				} else {
					$waktu = $detik.' detik yang lalu';
				}
			} else if ($menit <= 60) {
				$waktu = $menit.' menit yang lalu';
			} else if ($jam <= 24) {
				$waktu = $jam.' jam yang lalu';
			} else {
				$waktu = date('H:i', strtotime($datetime));
			}

			$datetime = $waktu;
		}
		# kemarin
		elseif (date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))) == date('Y-m-d', strtotime($datetime))) {
			$datetime = 'Kemarin ' . date('H:i', strtotime($datetime));
		}
		# lusa
		elseif (date('Y-m-d', strtotime('-2 day', strtotime(date('Y-m-d')))) == date('Y-m-d', strtotime($datetime))) {
			$datetime = '2 hari yang lalu ' . date('H:i', strtotime($datetime));
		}
		else {
			$datetime = tgl_jam_menit($datetime);
		}

		return $datetime;
	}
}

if (!function_exists('ucapan_auto')) {
	function ucapan_auto() {
		date_default_timezone_set("Asia/Jakarta");
		$b = time();
		$hour = date("G",$b);
		if ($hour>=0 && $hour<=11)
		{
			return "Selamat Pagi";
		}
		elseif ($hour >=12 && $hour<=14)
		{
			return "Selamat Siang";
		}
		elseif ($hour >=15 && $hour<=17)
		{
			return "Selamat Sore";
		}
		elseif ($hour >=17 && $hour<=18)
		{
			return "Selamat Petang";
		}
		elseif ($hour >=19 && $hour<=23)
		{
			return "Selamat Malam";
		}
	}
}

if (!function_exists('penyebut')) {
	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}

}

if (!function_exists('terbilang')) {
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}           
		return $hasil;
	}
}

if (!function_exists('searchArrayKeyVal')) {
	function searchArrayKeyVal($sKey, $id, $array) {
	   foreach ($array as $key => $val) {
		   if ($val[$sKey] == $id) {
			   return $key;
		   }
	   }
	   return false;
	}
}

if (!function_exists('formatPhoneNumber')) {
	function formatPhoneNumber($phoneNumber) {
		$phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

		if(strlen($phoneNumber) > 10) {
			$countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
			$areaCode = substr($phoneNumber, -10, 3);
			$nextThree = substr($phoneNumber, -7, 3);
			$lastFour = substr($phoneNumber, -4, 4);

			if (strlen($countryCode) == 1) {
				$countryCd = '+62'.$countryCode;
			} else if (strlen($countryCode) == 2) {
				$countryCd = '+'.str_replace('0', '62', $countryCode);
			} else {
				$countryCd = $countryCode;
			}
			$phoneNumber = $countryCd.$areaCode.$nextThree.$lastFour;
		}
		else if(strlen($phoneNumber) == 10) {
			$areaCode = substr($phoneNumber, 0, 3);
			$nextThree = substr($phoneNumber, 3, 3);
			$lastFour = substr($phoneNumber, 6, 4);

			$phoneNumber = $areaCode.$nextThree.$lastFour;
		}
		else if(strlen($phoneNumber) == 7) {
			$nextThree = substr($phoneNumber, 0, 3);
			$lastFour = substr($phoneNumber, 3, 4);

			$phoneNumber = $nextThree.$lastFour;
		}

		return $phoneNumber;
	}
}

if (!function_exists('getRealIP')) {
	function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}

if (!function_exists('getClientIP')) {
	function getClientIP() {
		if (isset($_SERVER)) {
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
				return $_SERVER["HTTP_X_FORWARDED_FOR"];
			if (isset($_SERVER["HTTP_CLIENT_IP"]))
				return $_SERVER["HTTP_CLIENT_IP"];
			return $_SERVER["REMOTE_ADDR"];
		}
		if (getenv('HTTP_X_FORWARDED_FOR'))
			return getenv('HTTP_X_FORWARDED_FOR');
		if (getenv('HTTP_CLIENT_IP'))
			return getenv('HTTP_CLIENT_IP');
		return getenv('REMOTE_ADDR');
	}
}

if (!function_exists('get_mac_address')) {
	function get_mac_address()
	{
		ob_start();
		system('ipconfig /all');
		$mycom = ob_get_contents();
		ob_clean();
		$findme = "Physical";
		$pmac = strpos($mycom, $findme);
		$mac = substr($mycom,($pmac+36),17);
		return $mac;
	}
}

if (!function_exists('get_jam')) {
	function get_jam()
	{
		$dat_server = mktime(date("G"), date("i"), date("s"), date("n"), date("j"), date("Y"));
		$diff_gmt = substr(date("O",$dat_server),1,2);
		$datdif_gmt = 60 * 60 * $diff_gmt;
		if (substr(date("O",$dat_server),0,1) == '+') {
			$dat_gmt = $dat_server - $datdif_gmt;
		} else {
			$dat_gmt = $dat_server + $datdif_gmt;
		}
		$datdif_id = 60 * 60 * 7;
		$dat_id = $dat_gmt + $datdif_id;
		$jam_input = date("H:i:s", $dat_id);
		return $jam_input;
	}

}

if (!function_exists('setPostCall')) {
	function setPostCall($var_url, $var_headers, $var_params) {
		$var_params_strings = '';
		foreach($var_params as $var_key => $var_value) {
			$var_params_strings .= $var_key . '=' . $var_value . '&';
		}
		rtrim($var_params_strings, '&');
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $var_url);
		if(isNotNull($var_headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $var_headers);
		}
		curl_setopt($ch, CURLOPT_POST, count($var_params));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $var_params_strings);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$var_result = curl_exec($ch);
		curl_close($ch);
		return $var_result;
	}
}

if (!function_exists('setPostCallNull')) {
	function setPostCallNull($var_url, $var_headers) {
	    $var_params_strings = '';
	   
	    rtrim($var_params_strings, '&');
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL, $var_url);
	    if(isNotNull($var_headers)) {
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $var_headers);
	    }
	    curl_setopt($ch, CURLOPT_POST, count(0));
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $var_params_strings);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $var_result = curl_exec($ch);
	    curl_close($ch);
	    return $var_result;
	}
}

if (!function_exists('setRawPostCall')) {
	function setRawPostCall($var_url, $var_raw) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $var_url);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $var_raw);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_VERBOSE, 1);
	    $var_result = curl_exec($ch);
	    curl_close($ch);
	    return $var_result;
	}
}

if (!function_exists('setGetCall')) {
	function setGetCall($var_url,$var_headers) {
	    $ch = curl_init($var_url);
	    curl_setopt($ch, CURLOPT_URL, $var_url);
	    if(isNotNull($var_headers)) {
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $var_headers);
	    }
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $var_result = curl_exec($ch);
	    curl_close($ch);
	    return $var_result;
	}
}

if (!function_exists('isNotNull')) {
	function isNotNull($var_value) {
	    if(is_array($var_value)) {
	        if(sizeof($var_value) > 0) {
	            return true;
	        } else {
	            return false;
	        }
	    } else {
	        if(($var_value != '') && (strtolower($var_value) != 'null') && (strlen(trim($var_value)) > 0)) {
	            return true;
	        } else {
	            return false;
	        }
	    }
	}
}

if (!function_exists('InfoFooter')) {
	function InfoFooter() {
		$sql = DB::table('info')->select('content')->where('active','=','1')->get();
		foreach ($sql as $row) {
			echo '<li>'.$row->content.'</li>';
		}
	}
}

if (!function_exists('sess_menu')) {
	function sess_menu() {
		$sql = Session::get('menu-'.Auth::User()->role);
		if (!empty($sql)) {
			$arr = array();
			foreach ($sql as $row) {
				$arr[] = $row->url;
			}
			return $arr;
		} else {
			return array();
		}
	}
}

if (!function_exists('app_version')) {
	function app_version() {
		return "1.1";
	}
}

function base64_encode_file($filename)
{
	if ($filename) {
		$type = pathinfo($filename, PATHINFO_EXTENSION);
		$data = file_get_contents($filename);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
	}
}


/**	 
 *
 * @param integer $angka number
 * @return string
 *
 * Usage example:
 * echo convert_to_rupiah(10000000); -> "Rp. 10.000.000"	 
 */ 
function convert_to_rupiah($angka)
{
	$hasil_rupiah = number_format($angka, 0,',','.');
	return $hasil_rupiah;
}

function convert_number_to_words($number)
{
	$hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}

function random($panjang_karakter)  
{  
	$karakter = '1234567890abcdefghijklmnopqrstuvwxyz';  
	$string = '';  
	for($i = 0; $i < $panjang_karakter; $i++) {  
		$pos = rand(0, strlen($karakter)-1);  
		$string .= $karakter[$pos];
	}
	return $string;  
}

function validate_email($email) {
    // Remove all illegal characters from email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function search_param($data, $search)
{
	if (strpos(strtolower($data), strtolower($search)) !== false) {
		return true;
	} else {
		return false;
	}
}

if (!function_exists('set_active')) {

    function set_active($route) {
        if (Route::is($route)) {
            return 'active';
        }
    }
}

if (!function_exists('total_diskon')) {
  function total_diskon($diskon) {
    $total = '';
    $harga_diskon = ($diskon / 100) * 3000000;
    $total = 3000000 - $harga_diskon;

    return $total;
  }
}