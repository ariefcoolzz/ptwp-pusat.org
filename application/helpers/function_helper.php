<?php
function pool($hrf)
{
	$huruf[1] = "A";
	$huruf[2] = "B";
	$huruf[3] = "C";
	$huruf[4] = "D";
	$huruf[5] = "E";
	$huruf[6] = "F";
	$huruf[7] = "G";
	$huruf[8] = "H";
	$huruf[9] = "I";
	$huruf[10] = "J";
	$huruf[11] = "K";
	$huruf[12] = "L";
	$huruf[13] = "M";
	$huruf[14] = "N";
	$huruf[15] = "O";
	$huruf[16] = "P";
	$huruf[17] = "Q";
	$huruf[18] = "R";
	$huruf[19] = "S";
	$huruf[20] = "T";
	$huruf[21] = "U";
	$huruf[22] = "V";
	$huruf[23] = "W";
	$huruf[24] = "X";
	$huruf[25] = "Y";
	$huruf[26] = "Z";

	return $huruf[$hrf];
}

function tanggal($tgl)
{
	if ($tgl != "") return "'" . $tgl->format('Y-m-d') . "'";
	else return "NULL";
}

function kosong($str)
{
	if (IS_OBJECT($str)) {
		return tanggal($str);
	} else {
		if ($str != "") return '"' . STR_REPLACE('"', "'", $str) . '"';
		else return "NULL";
	}
}

function rupiah($angka, $format = NULL)
{
	if ($angka == 0) {
		if ($format == NULL) {
			return "-";
		} else {
			return $format;
		}
	} else {
		return number_format($angka, 0, ',', '.');
	}
}

function bilangan($str)
{
	$hasil = intval(str_replace(".", "", $str));
	return $hasil;
}

function jenis_kelamin($str)
{
	if ($str == "L") return "Laki-Laki";
	else return "Perempuan";
}

function jenis_lapangan($str)
{
	if ($str == "0") return "In Door";
	else return "Out Door";
}

function flag($str)
{
	if ($str == '') return "";
	else {
		$array['D'] = "Delete";
		$array['I'] = "Insert";
		$array['U'] = "Update";
		$array['A'] = "Approved";
		return $array[$str];
	}
}

function flag_color($str)
{
	if ($str != 'A') $style = "class=bg-warning";
	else $style = "";

	return $style;
}

function is_active($str)
{
	if (!$str) $style = "bg-warning";
	else $style = "";

	return $style;
}

function is_active2($str)
{
	if ($str) $style = "success";
	else $style = "danger";

	return $style;
}

function jenis_usulan($int)
{
	$array[1] = "Atas Permintaan Sendiri (APS)";
	$array[2] = "Reguler";

	return $array[$int];
}

function tahap_hakim($int)
{
	$array[1] = "Usulan";
	$array[2] = "Rapat WKMA";
	$array[3] = "Rapat KMA";

	return $array[$int];
}

function tahap_proses_tpm_hakim($tahap, $proses)
{
	$hasil = "";

	$array[0] = "Proses";
	$array[1] = "Tolak";
	$array[2] = "Tunda";
	$array[3] = "Setujui";

	if ($tahap == 3) $keterangan_proses = " (" . $array[$proses] . ")";
	else $keterangan_proses = "";

	return tahap_hakim($tahap) . $keterangan_proses;
}

function tahap_panitera($int)
{
	$array[1] = "Usulan";
	$array[2] = "Rapat Dirjen";
	$array[3] = "Rapat MARI";

	return $array[$int];
}

function tahap_proses_tpm_panitera($tahap, $proses)
{
	$hasil = "";

	$array[0] = "Proses";
	$array[1] = "Tolak";
	$array[2] = "Tunda";
	$array[3] = "Setujui";

	if ($tahap == 3) $keterangan_proses = " (" . $array[$proses] . ")";
	else $keterangan_proses = "";

	return tahap_panitera($tahap) . $keterangan_proses;
}

function tahap_jurusita($int)
{
	$array[1] = "Usulan";
	$array[2] = "Rapat Dirjen";

	return $array[$int];
}

function tahap_proses_tpm_jurusita($tahap, $proses)
{
	$hasil = "";

	$array[0] = "Proses";
	$array[1] = "Tolak";
	$array[2] = "Tunda";
	$array[3] = "Setujui";

	if ($tahap == 2) $keterangan_proses = " (" . $array[$proses] . ")";
	else $keterangan_proses = "";

	return tahap_jurusita($tahap) . $keterangan_proses;
}

function format_tanggal($str1, $str2)
{
	if (substr($str2, 2, 1) == "/" or substr($str2, 2, 1) == "-") //Tanggal Nya Di Balik Dulu kalo jenis nya xx/xx/xxxx
	{
		$str2 	= substr($str2, 6, 4) . "-" . substr($str2, 3, 2) . "/" . substr($str2, 0, 2);
	}

	if ($str2 != NULL and $str2 != "0000-00-00") {
		$dd		= substr($str2, 8, 2);
		$mm 	= substr($str2, 5, 2);
		$yyyy 	= substr($str2, 0, 4);
		switch ($mm) {
			case "1":
				$mmm = 'Jan';
				break;
			case "2":
				$mmm = 'Feb';
				break;
			case "3":
				$mmm = 'Mar';
				break;
			case "4":
				$mmm = 'Apr';
				break;
			case "5":
				$mmm = 'Mei';
				break;
			case "6":
				$mmm = 'Jun';
				break;
			case "7":
				$mmm = 'Jul';
				break;
			case "8":
				$mmm = 'Agu';
				break;
			case "9":
				$mmm = 'Sep';
				break;
			case "10":
				$mmm = 'Okt';
				break;
			case "11":
				$mmm = 'Nov';
				break;
			case "12":
				$mmm = 'Des';
				break;
		}
		switch ($mm) {
			case 1:
				$mmmm = 'Januari';
				break;
			case 2:
				$mmmm = 'Pebruari';
				break;
			case 3:
				$mmmm = 'Maret';
				break;
			case 4:
				$mmmm = 'April';
				break;
			case 5:
				$mmmm = 'Mei';
				break;
			case 6:
				$mmmm = 'Juni';
				break;
			case 7:
				$mmmm = 'Juli';
				break;
			case 8:
				$mmmm = 'Agustus';
				break;
			case 9:
				$mmmm = 'September';
				break;
			case 10:
				$mmmm = 'Oktober';
				break;
			case 11:
				$mmmm = 'Nopember';
				break;
			case 12:
				$mmmm = 'Desember';
				break;
		}

		switch (date("w", strtotime($str2))) {
			case "0":
				$w = 'Minggu';
				$h = "Mg";
				break;
			case "1":
				$w = 'Senin';
				$h = "Sn";
				break;
			case "2":
				$w = 'Selasa';
				$h = "Sl";
				break;
			case "3":
				$w = 'Rabu';
				$h = "Rb";
				break;
			case "4":
				$w = 'Kamis';
				$h = "Km";
				break;
			case "5":
				$w = "Jum'at";
				$h = "Jm";
				break;
			case "6":
				$w = 'Sabtu';
				$h = "Sb";
				break;
		}

		switch ($str1) {
			case "wdmy":
				return $h . ', ' . $dd . ' ' . substr($mmmm, 0, 3) . ' ' . substr($yyyy, 2, 2);
				break;
			case "wddmmmmyyyyhis":
				return $w . ', ' . $dd . ' ' . $mmmm . ' ' . $yyyy . ' ' . substr($str2, 11, 8);
				break;
			case "ddmmmmyyyyhis":
				return $dd . ' ' . $mmmm . ' ' . $yyyy . ' ' . substr($str2, 11, 8);
				break;
			case "wddmmmmyyyy":
				return $w . ', ' . $dd . ' ' . $mmmm . ' ' . $yyyy;
				break;
			case "ddmmmmyyyy":
				return $dd . ' ' . $mmmm . ' ' . $yyyy;
				break;
			case "ddmmmm":
				return $dd . ' ' . $mmmm;
				break;
			case "wddmmmm":
				return $w . ', ' . $dd . ' ' . $mmmm;
				break;
			case "ddmmmyy":
				return $dd . ' ' . $mmm . ' ' . substr($yyyy, 2, 2);
				break;
			case "ddmmmyyyy":
				return $dd . ' ' . $mmm . ' ' . $yyyy;
			case "ddmmyyyy":
				return $dd . '/' . $mm . '/' . $yyyy;
				break;
			case "wddmmyy":
				return $h . ', ' . $dd . '/' . $mm . '/' . substr($yyyy, 2, 2);
				break;
			case "ddmmyy":
				return $dd . '/' . $mm . '/' . substr($yyyy, 2, 2);
				break;
			case "mmmm":
				return $mmmm;
				break;
			case "yyyy":
				return $yyyy;
				break;
			case "yyyymmdd":
				return $yyyy . '/' . $mm . '/' . $dd;
				break;
			case "w":
				return $w;
				break;
			case "his":
				return substr($str2, 11, 8);
				break;
			default:
				return 'Format Salah';
				break;
		}
	} else {
		return "";
	}
}

function nama_bulan($nomor)
{
	$b = "";
	switch ($nomor) {
		case "1":
			$b = 'Januari';
			break;
		case "2":
			$b = 'Februari';
			break;
		case "3":
			$b = 'Maret';
			break;
		case "4":
			$b = 'April';
			break;
		case "5":
			$b = 'Mei';
			break;
		case "6":
			$b = 'Juni';
			break;
		case "7":
			$b = 'Juli';
			break;
		case "8":
			$b = 'Agustus';
			break;
		case "9":
			$b = 'September';
			break;
		case "10":
			$b = 'Oktober';
			break;
		case "11":
			$b = 'November';
			break;
		case "12":
			$b = 'Desember';
			break;
	}
	return $b;
}
function nama_hari($nomor)
{
	$w = "";
	switch ($nomor) {
		case "0":
			$w = 'Minggu';
			break;
		case "1":
			$w = 'Senin';
			break;
		case "2":
			$w = 'Selasa';
			break;
		case "3":
			$w = 'Rabu';
			break;
		case "4":
			$w = 'Kamis';
			break;
		case "5":
			$w = "Jumat";
			break;
		case "6":
			$w = 'Sabtu';
			break;
	}
	return $w;
}

function balik_tanggal($tgl, $format = NULL) //Format: dmy 12-01-2017,ymd 2017-01-12
{
	if ($tgl == "") {
		$tgl = "";
	} else {
		if ($format == NULL) {
			if (substr($tgl, 2, 1) == "/" or substr($tgl, 2, 1) == "-") {
				$tgl = substr($tgl, 6, 4) . "-" . substr($tgl, 3, 2) . "-" . substr($tgl, 0, 2);
			} else {
				$tgl = substr($tgl, 8, 2) . "/" . substr($tgl, 5, 2) . "/" . substr($tgl, 0, 4);
			}
		} else {
			if (substr($tgl, 2, 1) == "/" or substr($tgl, 2, 1) == "-") {
				if ($format == "dmy") {
					$tgl = $tgl;
				} else {
					$tgl = substr($tgl, 6, 4) . "/" . substr($tgl, 3, 2) . "/" . substr($tgl, 0, 2);
				}
			} else {
				if ($format == "ymd") {
					$tgl = $tgl;
				} else {
					$tgl = substr($tgl, 0, 4) . "-" . substr($tgl, 5, 2) . "-" . substr($tgl, 8, 2);
				}
			}
		}
	}
	return $tgl;
}

function tanggal_db($tgl)
{
	if ($tgl == "") {
		$tgl = "";
	} else {
		if (substr($tgl, 2, 1) == "/" or substr($tgl, 2, 1) == "-") {
			$tgl = substr($tgl, 6, 4) . "/" . substr($tgl, 3, 2) . "/" . substr($tgl, 0, 2);
		}
	}
	return $tgl;
}

function tanggal_dp($tgl)
{
	if ($tgl == "") {
		$tgl = "";
	} else {
		if (substr($tgl, 4, 1) == "/" or substr($tgl, 4, 1) == "-") {
			$tgl = substr($tgl, 0, 4) . "-" . substr($tgl, 5, 2) . "-" . substr($tgl, 8, 2);
		}
	}
	return $tgl;
}

function clean($str)
{
	return preg_match("/^[a-zA-Z0-9]+$/", $str);
}

function CEKNULL($str)
{
	if ($str == "") return "NULL";
	else return "\"$str\"";
}
function strposa($haystack, $needle = array(), $offset = 0)
{
	if (!is_array($needle)) $needle = array($needle);
	foreach ($needle as $query) {
		if (strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
	}
	return false;
}
function diperbantukan($int)
{
	if ($int == 1) return "Ya";
	else return "Tidak";
}

function opval($operator, $value)
{
	$hasil = "";
	if ($operator == 'IN') {
		$value = "'" . STR_REPLACE("|", "','", $value) . "'";
		$hasil = " $operator ($value)";
	} elseif ($operator == 'BETWEEN') {
		$explode = EXPLODE('|', $value);
		if ($explode[0] > $explode[1])
			$value = "'$explode[1]' AND '$explode[0]'";
		else
			$value = "'$explode[0]' AND '$explode[1]'";
		$hasil = " $operator $value";
	} elseif ($operator == 'LIKE') {
		$hasil = " $operator '%$value%'";
	} else {
		$hasil = " $operator \"$value\"";
	}
	return $hasil;
}

function nip_titik($nip)
{
	$nip = substr($nip, 0, 8) . "." . substr($nip, 8, 6) . "." . substr($nip, 14, 1) . "." . substr($nip, 15, 3);
	return $nip;
}

function nip_tanpa_titik($nip)
{
	$nip = str_replace(".", "", $nip);
	return $nip;
}

function ya($int)
{
	if ($int == 0) return "Tidak";
	elseif ($int == 1) return "Ya";
	else return "Salah: Value Harus 0 atau 1";
}


function class_bg($int)
{
	if ($int < 1) $hasil = "";
	elseif ($int > 1) $hasil = "bg-warning";
	else $hasil = "";
	return $hasil;
}

function class_bg_in($int)
{
	if ($int < 1) $hasil = "";
	elseif ($int >= 1) $hasil = "bg-success";
	else $hasil = "";
	return $hasil;
}

function class_bg_out($int)
{
	if ($int < 1) $hasil = "";
	elseif ($int >= 1) $hasil = "bg-danger";
	else $hasil = "";
	return $hasil;
}

function MD7($str)
{
	return MD5("PTWP" . $str . "MAHKAMAHAGUNG");
}

function MD7S($str)
{
	return "MD5(CONCAT('PTWP',CONCAT($str),'MAHKAMAHAGUNG'))";
}
function kategori_hukuman_disiplin($str)
{
	if ($str == '') return "";
	else {
		$array['0'] = "Ringan";
		$array['1'] = "Sedang";
		$array['2'] = "Berat";
		return $array[$str];
	}
}

function hitung_umur($tanggal_lahir)
{
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) {
		exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y . " tahun " . $m . " bulan ";
}
function cdn_foto($foto1 = null, $foto2 = null, $size = '120')
{  // MANA YG ADA, FOTO PROFIL ATAU FOTO PEGAWAI
	$img = 'https://dreamvilla.life/wp-content/uploads/2017/07/dummy-profile-pic.png';
	if (!empty($foto1))
		$img = "https://sikep.mahkamahagung.go.id/uploads/foto_pegawai/" . trim($foto1);
	if (!empty($foto2))
		$img = "https://sikep.mahkamahagung.go.id/uploads/foto_formal/" . trim($foto2);
	$cdn = "//images.weserv.nl/?url=" . $img . "&w=" . $size;
	return $cdn;
}

function if_null($int)
{
	IF(!$int > 0)
		return "";
	else 
		return $int;
}

function nama_singkat($nama)
	{
		$hasil = '';
		$PEMAIN = EXPLODE("<br>", $nama);
		IF(COUNT($PEMAIN) >= 0)
			{
				FOR($a=0;$a<COUNT($PEMAIN);$a++)
					{
						$nama_clean = $PEMAIN[$a];
						$nama_clean = STR_REPLACE("Hj. ", "", $nama_clean);
						$nama_clean = STR_REPLACE("H. ", "", $nama_clean);
						$nama_clean = STR_REPLACE("Hj.", "", $nama_clean);
						$nama_clean = STR_REPLACE("H.", "", $nama_clean);
						$nama_clean = STR_REPLACE("Drs. ", "", $nama_clean);
						$nama_clean = STR_REPLACE("Dra. ", "", $nama_clean);
						// $hasil = $PEMAIN[$a];
						$EXP = EXPLODE(" ", $nama_clean);
						IF(COUNT($EXP) > 0)
							{
								$hasil .= $EXP[0]." ";
								$hasil .= "<small>";
								FOR($i=1;$i<COUNT($EXP);$i++)
									{
										$hasil .= SUBSTR($EXP[$i],0,1)."."; 
									}
								$hasil .= "</small>";
							}
						$hasil .= "<br>";
					}
			}
		return $hasil;
	}