<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templatehelper{
	public function __construct(){
    }

    function strbefore($string, $substring) {
		$pos = strpos($string, $substring);
		if ($pos === false)
			return $string;
		else 
	   		return(substr($string, 0, $pos));
	}
	
    function ucname($string) {
    	if (strpos($string, 'I-')!==false) {
    		$explode=explode(' ', $string);
    		foreach ($explode as $key => $value) {
    			if (strpos($value, 'I-')==false) {
    				$explode[$key] =ucwords(strtolower($value));	
    			}
    		}
    		$string=implode(" ",$explode);
    	}else{
    		$string =ucwords(strtolower($string));	
    	}
        

        foreach (array(',','.','-', ' \'') as $delimiter) {
          if (strpos($string, $delimiter)!==false) {
          	$string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
          }
        }
        return $string;
    }
    function  getBulanFull($bln){
	    switch  ($bln){
	        case 1: return  "Januari"; break;
	        case 2: return  "Februari"; break;
	        case 3: return  "Maret"; break;
	        case 4: return  "April"; break;
	        case 5: return  "Mei"; break;
	        case 6: return  "Juni"; break;
	        case 7: return  "Juli"; break;
	        case 8: return  "Agustus"; break;
	        case 9: return  "September"; break;
	        case 10: return "Oktober"; break;
	        case 11: return "November"; break;
	        case 12: return "Desember"; break;
	    }
	}
    function validateDate($date){
	    if (empty($date)) return false;
	    $date = str_replace('/', '-', $date);
		$d = DateTime::createFromFormat('Y-m-d', $date);
	    return $d && $d->format('Y-m-d') == $date;
	}
    function convertKeTglIndo($tgl){
    	# contoh: 21 April 2014
	    if (!$this->validateDate($tgl)) return $tgl; 
	    $tanggal_ = substr($tgl,8,2);
	    if($tanggal_>=10){
	    	$tanggal = $tanggal_;
	    }elseif($tanggal_<10){
	    	$tanggal = substr($tgl,9,2);
	    }
	    $bulan_ =  $this->getBulanFull(substr($tgl,5,2));
	    $tahun_ =  substr($tgl,0,4);
	    return  $tanggal.' '.$bulan_.' '.$tahun_;

	}
	
	function  convertKeTglDatepicker($tgl){
    $tanggal = substr($tgl,8,2);
    $bulan   = substr($tgl,5,2);
    $tahun   = substr($tgl,0,4);
    return  $tanggal.'/'.$bulan.'/'.$tahun;	
	}
	
    public function standradnaming($str){
        $str = $this->ucname($str);
        $str = str_replace(', Sh', ', S.H.', $str);
        $str = str_replace(',Sh', ', S.H.', $str);
        $str = str_replace('.Sh', ', S.H.', $str);
        $str = str_replace(' Sh', ', S.H.', $str);
        $str = str_replace('.S.H', ', S.H.', $str);
        $str = str_replace(', Mh', ', M.H.', $str);
        $str = str_replace(',Mh', ', M.H.', $str);
        $str = str_replace('.MH', ', M.H.', $str);
        $str = str_replace('.M.H', ', M.H.', $str);
        $str = str_replace('Pns', 'PNS', $str);
        $str = str_replace('Spn', 'SPN', $str);
        $str = str_replace('Cq', 'cq', $str);
        $str = str_replace('Tni', 'TNI', $str);
        $str = str_replace('Polri', 'POLRI', $str);
        $str = str_replace('Pt', 'PT', $str);
        $str = str_replace('Als', 'als', $str);
        $str = str_replace('Als.', 'als', $str);
        $str = str_replace('pid.B', 'Pid.B', $str);
        $str = str_replace('pid.Sus', 'Pid.Sus', $str);
        $str = str_replace('/pid/', '/PID/', $str);
        $str = str_replace('/pn', '/PN', $str);
        $str = str_replace('/pt.', '/PT ', $str);
        return $str;
    }
    public function converToAngkaRomawi($integer, $upcase = true){ 
	    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
	    $return = ''; 
	    while($integer > 0) 
	    { 
	        foreach($table as $rom=>$arb) 
	        { 
	            if($integer >= $arb) 
	            { 
	                $integer -= $arb; 
	                $return .= $rom; 
	                break; 
	            } 
	        } 
	    } 

	    return $return; 
	}
	function  getHari($tgl){
		if(empty($tgl))
			return '';
    	$namahari = array('Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    	$hari =date('w', strtotime($tgl));
    	return  $namahari[$hari];
	}
	
	public function Terbilang_saksi($x){
		if ($x==''){
			$x=0;
		}
		switch ($x) {
			case 0:
				$tmp='';
				break;
			case 1:
				$tmp='pertama';
				break;
			default:
				$tmp='ke '.$this->Terbilang($x);
				break;
		}
		return $tmp;
	}

	public function Terbilang($x){
		if ($x==''){
			$x=0;
		}
		$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
			if ($x < 12)
				return " " . $abil[$x];
			elseif ($x < 20)
    			return $this->Terbilang($x - 10) . " belas";
    		elseif ($x < 100)
    			return $this->Terbilang($x / 10) . " puluh" .$this->Terbilang($x % 10);
    		elseif ($x < 200)
    			return " seratus" .$this->Terbilang($x - 100);
    		elseif ($x < 1000)
    			return $this->Terbilang($x / 100) . " ratus" .$this->Terbilang($x % 100);
    		elseif ($x < 2000)
    			return " seribu" .$this->Terbilang($x - 1000);
    		elseif ($x < 1000000)
    			return $this->Terbilang($x / 1000) . " ribu" .$this->Terbilang($x % 1000);
    		elseif ($x < 1000000000)
    			return $this->Terbilang($x / 1000000) . " juta" .$this->Terbilang($x % 1000000);
	}
	function cleanHtmlTag($text){
		$text = filter_var($text, FILTER_SANITIZE_STRING);
		$text = str_replace('&#39;',"'",$text);
		$text = str_replace('&#39;',"'",$text);
		$text = str_replace('&#150;',"-",$text);
		$text = str_replace('&#146;',"'",$text);
		$text = str_replace('&#160;',' ',$text);
		$text = str_replace(';','; ',$text);
	    $text = str_replace('&nsbp',' ',$text);
		$text = str_replace('MENGADILI','',$text);
	    $text = str_replace('Mengadili','',$text);
	    $text = str_replace(':','',$text);
	    $text = str_replace("&nbsp; ","",$text);
	    $text = str_replace("</p>","",$text);	   	    
		$tmp = explode(';', $text);
		$tmptext = '';

		for ($i=0; $i < count($tmp); $i++){
			if($i!=0 AND strlen($tmp[$i]) >5){
				$tmptext .='\\par';
			}
			
			$tmp[$i]= preg_replace('/\t+/', '', $tmp[$i]);
			$tmptext .= $tmp[$i].';';
		}
		$text = $tmptext;		
		$text = trim($text);

		return $text;
	}

	function cleanHtmlTagSpecial($text){
		$text = str_replace(chr(194),"",$text);
		$text = html_entity_decode($text, ENT_QUOTES, "UTF-8");
		// $text = str_replace("MENETAPKAN:","MENETAPKAN:"."\\pard"."\\qc"."\\sa100",$text);
		$text = str_replace("MENETAPKAN:"," ",$text);
		$text = str_replace("MENETAPKAN :"," ",$text);
		$text = str_replace("M E N E T A P K A N :"," ",$text);
		$text = str_replace("M E N G A D I L I"," ",$text);
		$text = str_replace("MENUNTUT :"," ",$text);
		$text = str_replace("  "," ",$text);
		$text = str_replace("<ol>","<ol type='1'> ",$text);		
		$text = str_replace("</li>","</li> \\par ",$text);
		$text = str_replace("<li>","<li> \\tab ",$text);
		$text = str_replace("<li >","<li> \\tab ",$text);
		$text = str_replace("</ol>","</ol> ",$text);
		$text = str_replace("</p>","\\par",$text);
		$text = str_replace("<strong>","\\b ",$text);
		$text = str_replace("</strong>","\\b0 ",$text);
		$text = str_replace("<p>1.","\\pard "."\\qj "."\\li630 "."\\linestarts 1. ",$text);		
		$text = filter_var($text, FILTER_SANITIZE_STRING);
		$text = str_replace('&#39;',"'",$text);
		$text = str_replace('&#34;','"',$text);
		$text = str_replace('&#160;',' ',$text);
		$text = str_replace(';','; ',$text);
	    $text = str_replace('&nsbp',' ',$text);
		$text = str_replace('MENGADILI','',$text);
	    $text = str_replace('Mengadili','',$text);
	    $text = str_replace("&nbsp; ","",$text);
	    $text = str_replace("</p>","",$text);
	    $text = str_replace('”'," ",$text);		
	    $text = str_replace('“'," ",$text);
		$text = trim($text);

		return $text;
	}
    //Update by beny bandung 20/12/2017
	public function namaKota($kota){
		$kotaucfirst = ucfirst($kota);
		$replace = array("Tata Usaha Negara","PENGADILAN","NEGERI","AGAMA","agama","Agama","Mahkamah","SYAR'IYAH","Syar'Iyah","MAHKAMAH","Pengadilan","Negeri","Kelas","MILITER"," III"," II"," I","Ia","Ib","KHUSUS","TATA USAHA NEGARA","1","2","3","4","5","6","7","8","9","0","-");
		$namaKotax = ucfirst(str_replace($replace,"",$kotaucfirst));
		return ltrim($namaKotax);
	} 


	public function namaKotaPA($kota){
		$kotaucfirst = ucfirst($kota);
		$replace = array("Pengadilan","PENGADILAN","AGAMA","agama","Agama","Mahkamah","SYAR'IYAH","Syar'Iyah","MAHKAMAH","1","2","3","4","5","6","7","8","9","0","-");
		$namaKotax = ucfirst(str_replace($replace,"",$kotaucfirst));
		return ltrim($namaKotax);
	}


	
	function convertToRomawi($integer, $upcase = true) 
	{ 
	    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
	    $return = ''; 
	    while($integer > 0) 
	    { 
	        foreach($table as $rom=>$arb) 
	        { 
	            if($integer >= $arb) 
	            { 
	                $integer -= $arb; 
	                $return .= $rom; 
	                break; 
	            } 
	        } 
	    } 

	    return $return; 
	} 
	function convertToRomawi_backup($bulan){
		switch ($bulan) {
			case '01':
				$bulan='I';
			break;
			case '02':
				$bulan='II';
			break;
			case '03':
				$bulan='III';
			break;
			case '04':
				$bulan='IV';
			break;
			case '05':
				$bulan='V';
			break;	
			case '06':
				$bulan='VI';
			break;		
			case '07':
				$bulan='VII';
			break;
			case '08':
				$bulan='VIII';
			break;
			case '09':
				$bulan='IX';
			break;	
			case '10':
				$bulan='X';
			break;
			case '11':
				$bulan='XI';
			break;
			case '12':
				$bulan='XII';
			break;
		}
		return $bulan;
	}


	function makeInt($angka) {
	if ($angka < -0.0000001) {
		return ceil($angka-0.0000001);
	} else {
		return floor($angka+0.0000001);
	}
}

	function convertToHijriah($tanggal) {
			$array_bulan = array("Muharram", "Safar", "Rabiul Awwal", "Rabiul Akhir","Jumadil Awwal","Jumadil Akhir", "Rajab", "Syaâ€™ban","Ramadhan","Syawwal", "Zulqaidah", "Zulhijjah");
		$date = $this->makeInt(substr($tanggal,8,2));
		$month = $this->makeInt(substr($tanggal,5,2));
		$year = $this->makeInt(substr($tanggal,0,4));
		if (($year>1582)||(($year == "1582") && ($month > 10))||(($year == "1582") && ($month=="10")&&($date >14))) {
			$jd = $this->makeInt((1461*($year+4800+$this->makeInt(($month-14)/12)))/4)+
			$this->makeInt((367*($month-2-12*($this->makeInt(($month-14)/12))))/12)-
			$this->makeInt( (3*($this->makeInt(($year+4900+$this->makeInt(($month-14)/12))/100))) /4)+
			$date-32075;
		} else {
			$jd = 367*$year-$this->makeInt((7*($year+5001+$this->makeInt(($month-9)/7)))/4)+
			$this->makeInt((275*$month)/9)+$date+1729777;
		}

		$wd = $jd%7;
		$l = $jd-1948440+10632;
		$n=$this->makeInt(($l-1)/10631);
		$l=$l-10631*$n+354;
		$z=($this->makeInt((10985-$l)/5316))*($this->makeInt((50*$l)/17719))+($this->makeInt($l/5670))*($this->makeInt((43*$l)/15238));
		$l=$l-($this->makeInt((30-$z)/15))*($this->makeInt((17719*$z)/50))-($this->makeInt($z/16))*($this->makeInt((15238*$z)/43))+29;
		$m=$this->makeInt((24*$l)/709);
		$d=$l-$this->makeInt((709*$m)/24);
		$y=30*$n+$z-30;
		$g = ($m%12)-1;
		if ($g==-1){
			$g=11;
		}
		$final = "$d $array_bulan[$g] $y ";
		return $final;
	}

	function cleanNamaGelar($nama){
		$nama = strtoupper($nama);
		$tmp = explode(' ', $nama);
		for ($i=0; $i < count($tmp); $i++) { 
			$tmp[$i] = trim($this->parseNama($tmp[$i]));
		}
		$cleanname = '';
		for ($i=0; $i < count($tmp); $i++) {
			if(!empty($tmp[$i])){
				$cleanname .= ' '.$tmp[$i];
			}		
		}
		return trim($cleanname);
	}

	function parseNama($txt){
		$txt = str_replace('S.H.', '', $txt);
		$txt = str_replace('SH', '', $txt);
		$txt = str_replace('SH.', '', $txt);
		$txt = str_replace('SH.,', '', $txt);
		$txt = str_replace('MH', '', $txt);
		$txt = str_replace('M.H', '', $txt);
		$txt = str_replace('M.H.,', '', $txt);
		$txt = str_replace('DRA', '', $txt);
		$txt = str_replace('DRA.', '', $txt);
		$txt = str_replace('DRS', '', $txt);
		$txt = str_replace('DRS.', '', $txt);
		$txt = str_replace('DRS.,', '', $txt);
		$txt = str_replace('DR', '', $txt);
		$txt = str_replace('DR.', '', $txt);
		$txt = str_replace('MHUM', '', $txt);
		$txt = str_replace('M.HUM', '', $txt);
		$txt = str_replace('MHUM.', '', $txt);
		$txt = str_replace('MHUM.,', '', $txt);
		$txt = str_replace('M.HUM.,', '', $txt);
		$txt = str_replace('SAG', '', $txt);
		$txt = str_replace('SAG.', '', $txt);
		$txt = str_replace('S.AG', '', $txt);
		$txt = str_replace('S.AG.,', '', $txt);
		$txt = str_replace('LC', '', $txt);
		$txt = str_replace('LC.', '', $txt);
		$txt = str_replace('L.C.', '', $txt);
		$txt = str_replace('MHI', '', $txt);
		$txt = str_replace('M.H.I', '', $txt);
		$txt = str_replace('MH.I', '', $txt);
		$txt = str_replace('H.', '', $txt);
		$txt = str_replace('H,', '', $txt);
		$txt = str_replace('HJ.', '', $txt);
		$txt = str_replace('HJ,', '', $txt);
		$txt = str_replace('.', ' ', $txt);
		$txt = str_replace(',', ' ', $txt);
		$txt = str_replace('.,', ' ', $txt);
		return $txt;
	}
	
	function isnull($txt){
		if($txt==''||$txt=='0'){
			$ret='-';
		}else{
			$ret=$txt;
		}
		return $ret;
	}
	     
	//edited by mashen 04/01/2018

    	function ambil_kecamatan($alamat) {

         $kecamatan='';
		 $A = explode(' ',trim($alamat));
	     
	     for ($i=0; $i<=count($A)-1 ; $i++) { 
	      	
	      	 if (strtoupper($A[$i]) == 'KECAMATAN')  {
	      	 	break;
	         }
		       
		  } 

	   
	      for ($i=$i; $i<=count($A)-1 ; $i++) { 
	   	
	        if ((strtoupper($A[$i]) =='KABUPATEN') || (strtoupper($A[$i])== 'KOTA') || (strtoupper($A[$i])== 'KAB') || (strtoupper($A[$i]) == 'KAB.')) {
	      	 	break;
	         }
	     	  else {
		        
		         if (strtoupper($A[$i])<>'KECAMATAN') {

		        $kecamatan=$kecamatan." ".$A[$i];

		       }
	        }


		  }
        return  "Kecamatan ".$kecamatan;
	}

    
    function ambil_kabupaten($alamat) {
      
        $A = explode(' ',trim($alamat));
        $kab='';
       for ($i=0; $i<=count($A)-1 ; $i++) { 
      	
      	 if (strtoupper($A[$i]) == 'KECAMATAN')  {
      	 	break;
         }
	       
	  } 

   
      for ($i=$i; $i<=count($A)-1 ; $i++) { 
      	
        if ((strtoupper($A[$i]) =='KABUPATEN') || (strtoupper($A[$i])== 'KOTA') || (strtoupper($A[$i])== 'KAB') || (strtoupper($A[$i]) == 'KAB.')) {
      	 	break;
         }
     	  else {
	        
	         if (strtoupper($A[$i])<>'KECAMATAN') {
	            echo '';
	       }
        }

	 }


	  for ($i=$i; $i<=count($A)-1 ; $i++) { 
      	
     
       if ((strtoupper($A[$i]) == 'KABUPATEN') || (strtoupper($A[$i]) == 'KOTA') || (strtoupper($A[$i]) == 'KAB') || (strtoupper($A[$i]) == 'KAB.')) {
         echo '';
       }
          else {

             	if ((strtoupper($A[$i]) <> 'KABUPATEN') || (strtoupper($A[$i]) <> 'KOTA') || (strtoupper($A[$i]) <> 'KAB') || (strtoupper($A[$i]) <> 'KAB.')) {
      	 	   
	      	 	     if ((strtoupper($A[$i-1]) == 'KABUPATEN') || (strtoupper($A[$i-1]) == 'KAB')) {

	                    $kabupaten="Kabupaten ";
	      	 	     
	      	 	     } else if (strtoupper($A[$i-1]) == 'KOTA') {

	                    $kabupaten="Kota ";

	      	 	     } 

                  $kab=$kab." ".$A[$i];
              
               }


          }

	 }

        return $kabupaten." ".$kab;

    }



}