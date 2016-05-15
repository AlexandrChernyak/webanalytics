<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Модуль плагинов общих параметров сайта
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 abstract class ss_Plugin_GenTemplate extends ss_Plugin_EnginesOpt { 
    
  function __construct(ss_Plugin_obj_List $AOwner, $id, $name, $daysstored=2, $checkYandexXML=false) {     	
   parent::__construct($AOwner, $id, '', $name, $name, $daysstored, $checkYandexXML);	
  }//__construct	
  	 	  	
 }//ss_Plugin_GenTemplate 
 //-----------------------------------------------------------------
 /** некоторые блоки констант */
 class ss_BlockConstantValue {
  //каталог google	
  const GOOLE_DIR = 'http://www.google.com/search?q=url%3A[url_host]&hl=ru&cat=gwd%2FTop';
  //сайты из Я каталога
  const YANDEX_DIR_LINKS = 'http://yaca.yandex.ru/yca?text=%22[url_host_no_www]%22';
  //google блоги
  const GOOGLE_BLOGS = 'http://blogsearch.google.ru/?hl=ru&tab=wb&q=[url_host]';
  //yandex images
  const YANDEX_IMAGES = 'http://images.yandex.ru/yandsearch?text=[url_host_no_www]&stype=image';
  //google images
  const GOOGLE_IMAGES = 'http://images.google.ru/images?hl=ru&source=imghp&q=[url_host_no_www]&gbv=2&aq=f';
  //in google cach
  const GOOGLE_CACH = 'http://webcache.googleusercontent.com/search?q=cache:http%3A//[url_host]/';
  //in yandex cach
  const YANDEX_CACH = 'http://hghltd.yandex.net/yandbtm?fmode=inject&url=http%3A%2F%2F[url_host]%2F&text=[url_host_no_www]&l10n=ru&keyno=0';
  //похожие в google
  const GOOGLE_RELAETED = 'http://www.google.ru/search?q=related:[url_host]/&filter=0';
  //history
  const SITE_HISTORY = 'http://web.archive.org/web/*/http://[url_host]';
  //answers in mail.ru
  const MAIL_ANSWERS = 'http://search.otvet.mail.ru/?q=[url_host_no_www]';
  //plagiat
  const PLAGIAT_SEARCH = 'http://www.copyscape.com/?q=[url_host]';
  //html validate
  const HTML_VALIDATE = 'http://validator.w3.org/check?uri=http://[url_host]';
  //css validate
  const CSS_VALIDATE = 'http://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2F[url_host]';
  //ping
  const PING_TRACEROUT = 'http://network-tools.com/default.asp?prog=express&host=[url_host]';
  //speed loadpage
  const PAGE_SPEED_LOAD = 'http://webo.in/check/?url=[url_host]';
  //robots.txt on yandex
  const CHECK_ROBOTSTXT_WEBYAND = 'http://webmaster.yandex.ru/robots.xml?hostname=http://[url_host]/';
  //search in yandex
  const YANDEX_SEARCH_RESULT = 'http://yandex.ru/yandsearch?text=';
  //search in google
  const GOOGLE_SEARCH_RESULT = 'http://www.google.com/search?q='; 
  //yandex cy
  const YANDEX_CY_RESULT = 'http://search.yaca.yandex.ru/yca/cy/ch/[url_real_host]';
  //liveinternet view
  const LIVEINTERNET_RESULT = 'http://www.liveinternet.ru/stat/[url_real_host]/';
  //domain expire
  const DOMAINEXPIRE_RESULT_WHDM = 'http://[MY_HOST]/tools/whoisdomain/[url_host]';
  //view site in ather resolution's
  const URL_ATHER_RESOLUTION = 'http://mini.site-shot.com/1024x768/600/jpeg/?http://[url_real_host]';
  //view to register domain
  //const DOMAIN_IS_AVAILEABLE = '';
   	
 }//ss_BlockConstantValue
 //-----------------------------------------------------------------
 /** Яндекс тиц */
 final class ss_Plugin_GenYandexCY extends ss_Plugin_GenTemplate {  	
  const LINK_QUERY = 'http://bar-navig.yandex.ru/u?ver=2&url=http://[url_real_host_no_www]&show=0';
  
  const LINK_CY_IMAGE_WWW = 'http://yandex.ru/cycounter/?[url_real_host_www]';
  const LINK_CY_IMAGE_NO_WWW = 'http://yandex.ru/cycounter/?[url_real_host_no_www]';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenYandexCY', 'Яндекс ТиЦ', 2);	 
  }//__construct  
  
  protected function _DoGetFromDataText(ss_ConnectQuery &$Request) {
   $res = array(
    'image_with_www' => $this->GetConnect()->ReplaceCorrect(self::LINK_CY_IMAGE_WWW),
    'image_without_www' => $this->GetConnect()->ReplaceCorrect(self::LINK_CY_IMAGE_NO_WWW)    
   );
   if (@preg_match("/value[\s]*=[\s]*\"(.\d*)\"/isU", $Request->GetData(), $ar)) {
    $res['value'] = trim($ar[1]); 
   }
   if (@preg_match("/rang[\s]*=[\s]*\"(.\d*)\"/isU", $Request->GetData(), $ar)) {
    $res['rang'] = trim($ar[1]); 
   }   
   if (@preg_match("/topic[\s]+title[\s]*=[\s]*\"(.*)\"/isU", $Request->GetData(), $ar)) {
   	$res['yacacatalog'] = (($pps = $this->strpos($ar[1], ':')) !== false) ? 
	trim($this->substr($ar[1], $pps+1)) : trim($ar[1]);	
   	//$res['yacacatalog'] = trim($ar[1]);	      	
   }	  
   if (@preg_match(DoEncodeDataToDef("/[\r|\n]регион[\s]*:[\s]*([^\r\n\<]*)/isu"), $Request->GetData(), $ar)) {
   	$res['regionurl'] = trim($ar[1]);	      	
   }   
   $res['comperewww'] = (@preg_match("/yaca[\s]+url[\s]*=[\s]*\"(.*)\"/isU", $Request->GetData(), $ar) && 
   ($this->strtolower(trim($ar[1])) == $this->strtolower($this->GetConnect()->url_real_host_with_www)))?true:false;   
   return $res;      	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   $Request->connect_specidy_encoded_page = 'windows-1251';
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) {
   	$Request->connect_specidy_encoded_page = false;  
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   $Request->connect_specidy_encoded_page = false;
   return false;      	
  }//ExecPlugin  
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; }
  	
 }//ss_Plugin_GenYandexCY
 //-----------------------------------------------------------------
 /** google pr */
 final class ss_Plugin_GenGooglePR extends ss_Plugin_GenTemplate {
  private $pr_obj = false;	  	
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenGooglePr', 'Google PR', 2);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();	
   if (!@class_exists('Google_PR_obj')) {
	return $this->SetError('Class Google_PR_obj not found! Can`t get google pr!');
   }
   if (!$this->pr_obj) {
	$this->pr_obj = new Google_PR_obj();
    $this->pr_obj->userAgent = SS_USERAGENTDATASET;
    $this->pr_obj->debug = true;
   }
   if ($params && @is_array($params)) {
	$this->pr_obj->googleDomains = $params;	
   }
   $res = array();   
   try {
	$res['value'] = $this->pr_obj->GetPR($this->GetConnect()->url_self);
	$sdebag = $this->pr_obj->debugResult;
	if ($sdebag) {
	 $res['host'] = trim(@$this->substr($sdebag['host'], 0, @$this->strpos($sdebag['host'],"(L")));
	 $res['time'] = trim(@$this->substr($sdebag['total_exec_time'], 0,@$this->strpos($sdebag['total_exec_time'],"(")));
	 if (!$res['value']) { $res['value'] = '0'; }
	}
	return $res;
   }
   catch (Exception $e)  {
   	return $this->SetError($e->getMessage());
   }   
   return false;      	
  }//ExecPlugin
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   $str = $this->GetConnect()->url_self.(($params = $this->GetRunParams()) ? @implode('-', $params) : '');	
   return @md5($this->strtolower($str));	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; }  
  	
 }//ss_Plugin_GenGooglePR
 //-----------------------------------------------------------------
  /** tcp ping */
 final class ss_Plugin_ActionTCPPing extends ss_Plugin_GenTemplate {	  	
  private $par = false;
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'ActionTCPPing', 'Http Ping', -1);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();	
   if (!@class_exists('TcpPing')) {
	return $this->SetError('Class TcpPing not found! Can`t action Ping!');
   }
   $this->par = ($params && @is_array($params));
   $ping = new TcpPing(($this->par && isset($params['host'])) ? $params['host'] : $this->GetConnect()->url_real_host);
   $count = ($this->par && isset($params['count']) && @is_numeric($params['count'])) ? $params['count'] : 5; 
   $res = array();   
   try {
    for ($i=1; $i<=$count; $i++) {
	 if (!$ping->Ping()) {
	  return $this->SetError($ping->GetErrorMessage());	
	 }
	 $res[] = array(
	  'time' => $ping->GetTime(),
	  'to'   => $ping->GetTargetAddress(),
	  'obj'  => $ping,
	  'tl'   => $i
	 ); 	 
	 if ($this->par && isset($params['sleep'])) { @sleep($params['sleep']); }	 	
	}
	return ($res) ? $res : false;     
   }
   catch (Exception $e)  {
   	return $this->SetError($e->getMessage());
   }   
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_ActionTCPPing
 //-----------------------------------------------------------------
 
 /** alexa rank */
 final class ss_Plugin_GenAlexaRank extends ss_Plugin_GenTemplate {  	
  const LINK_QUERY = 'http://data.alexa.com/data?cli=10&dat=snbamz&url=[url_real_host]';
  const LINK_GRAPH = 'http://traffic.alexa.com/graph?c=1&f=555555&u=[url_real_host]&u=&u=&u=&u=&r=6m&y=r&z=1&';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenAlexaRank', 'Alexa Rank', 2);	 
  }//__construct  
  
  protected function _DoGetFromDataText(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   $linked = '';
   if ($params && @is_array($params)) {
	$linked .= 'h='.((isset($params['h'])) ? $params['h'].'&' : '100&');
	$linked .= 'w='.((isset($params['w'])) ? $params['w'] : '180');	
   } else { $linked = 'h=100&w=180'; }		
   $res = array(
    'graph' => $this->GetConnect()->ReplaceCorrect(self::LINK_GRAPH.$linked)
   );
   if (@preg_match('/\<popularity url\="(.*?)" text\="([0-9]+)"/isU', $Request->GetData(), $ar)) {
    $res['value'] = (trim($ar[2]) == '') ? '0' : trim($ar[2]);    
   }	
   return $res;        	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) {  
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin 
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; } 
  	
 }//ss_Plugin_GenAlexaRank
 //-----------------------------------------------------------------
 /** whois domain */
 final class ss_Plugin_GenWhoisDomain extends ss_Plugin_GenTemplate {  	
  /** порт */
  private $port = 43;
  /** время ожидания */
  private $timeout = 10;
  /** список серверов */
  private $whoisservers = array(
    
    "xn--p1ai" => "whois.nic.ru",
    "travel"   => "whois.nic.travel",
    "museum"   => "whois.museum",
    "aero"	   => "whois.aero",
    "arpa" 	   => "whois.iana.org",
    "asia" 	   => "whois.nic.asia",
    "coop" 	   => "whois.nic.coop",
    "info" 	   => "whois.afilias.info",
    "jobs" 	   => "jobswhois.verisign-grs.com",
    "mobi" 	   => "whois.dotmobiregistry.net",
    "name" 	   => "whois.nic.name",
    "biz" 	   => "whois.biz",
    "org" 	   => "whois.pir.org",
    "cat" 	   => "whois.cat",
    "int" 	   => "whois.iana.org",
    "com" 	   => "whois.verisign-grs.com",
    "edu" 	   => "whois.educause.edu",
    "gov" 	   => "whois.nic.gov",
    "pro" 	   => "whois.registrypro.pro",
    "mil" 	   => "whois.nic.mil",
    "net" 	   => "whois.verisign-grs.net",
    "tel" 	   => "whois.nic.tel",
	"ac" 	   => "whois.nic.ac",
	"ae" 	   => "whois.nic.ae",
	"af" 	   => "whois.nic.af",
	"ag" 	   => "whois.nic.ag",
	"al" 	   => "whois.ripe.net",
	"am" 	   => "whois.amnic.net",
	"as" 	   => "whois.nic.as",
	"at" 	   => "whois.nic.at",
	"au" 	   => "whois.aunic.net",
	"az" 	   => "whois.ripe.net",
	"ba" 	   => "whois.ripe.net",
	"be" 	   => "whois.dns.be",
	"bg" 	   => "whois.register.bg",
	"bi" 	   => "whois.nic.bi",
	"bj" 	   => "whois.nic.bj",
	"br" 	   => "whois.registro.br",
	"bt" 	   => "whois.netnames.net",
	"by" 	   => "whois.ripe.net",
	"bz" 	   => "whois.belizenic.bz",
	"ca" 	   => "whois.cira.ca",
	"cc" 	   => "whois.nic.cc",
	"cd" 	   => "whois.nic.cd",
	"ch" 	   => "whois.nic.ch",
	"ci" 	   => "whois.nic.ci",
	"ck" 	   => "whois.nic.ck",
	"cl" 	   => "whois.nic.cl",
	"cn" 	   => "whois.cnnic.net.cn",
	"cx" 	   => "whois.nic.cx",
	"cy" 	   => "whois.ripe.net",
	"cz" 	   => "whois.nic.cz",
	"de" 	   => "whois.denic.de",
	"dk" 	   => "whois.dk-hostmaster.dk",
	"dm" 	   => "whois.nic.cx",
	"dz" 	   => "whois.ripe.net",
	"ee" 	   => "whois.eenet.ee",
	"eg" 	   => "whois.ripe.net",
	"es" 	   => "whois.ripe.net",
	"eu" 	   => "whois.eu",
	"fi" 	   => "whois.ficora.fi",
	"fo" 	   => "whois.ripe.net",
	"fr" 	   => "whois.nic.fr",
	"gb" 	   => "whois.ripe.net",
	"gd" 	   => "whois.adamsnames.com",
	"ge" 	   => "whois.ripe.net",
	"gg" 	   => "whois.channelisles.net",
	"gi" 	   => "whois2.afilias-grs.net",
	"gl" 	   => "whois.ripe.net",
	"gm" 	   => "whois.ripe.net",
	"gr" 	   => "whois.ripe.net",
	"gs" 	   => "whois.nic.gs",
	"gw" 	   => "whois.nic.gw",
	"gy" 	   => "whois.registry.gy",
	"hk" 	   => "whois.hkirc.hk",
	"hm" 	   => "whois.registry.hm",
	"hn" 	   => "whois2.afilias-grs.net",
	"hr" 	   => "whois.ripe.net",
	"hu" 	   => "whois.nic.hu",
	"ie" 	   => "whois.domainregistry.ie",
	"il" 	   => "whois.isoc.org.il",
	"in" 	   => "whois.inregistry.net",
	"io" 	   => "whois.nic.io",
	"iq" 	   => "vrx.net",
	"ir" 	   => "whois.nic.ir",
	"is" 	   => "whois.isnic.is",
	"it" 	   => "whois.nic.it",
	"je" 	   => "whois.channelisles.net",
	"jp" 	   => "whois.jprs.jp",
	"ke" 	   => "whois.kenic.or.ke",
	"kg" 	   => "www.domain.kg",
	"ki" 	   => "whois.nic.ki",
	"kr" 	   => "whois.nic.or.kr",
	"kz" 	   => "whois.nic.kz",
	"la" 	   => "whois.nic.la",
	"li" 	   => "whois.nic.li",
	"lt" 	   => "whois.domreg.lt",
	"lu" 	   => "whois.dns.lu",
	"lv" 	   => "whois.nic.lv",
	"ly" 	   => "whois.nic.ly",
	"ma" 	   => "whois.iam.net.ma",
	"mc" 	   => "whois.ripe.net",
	"md" 	   => "whois.nic.md",
	"me" 	   => "whois.meregistry.net",
	"mg" 	   => "whois.nic.mg",
	"mn" 	   => "whois.nic.mn",
	"ms" 	   => "whois.adamsnames.tc",
	"mt" 	   => "whois.ripe.net",
	"mu" 	   => "whois.nic.mu",
	"mx" 	   => "whois.nic.mx",
	"my" 	   => "whois.mynic.net.my",
	"na" 	   => "whois.na-nic.com.na",
	"nf" 	   => "whois.nic.nf",
	"nl" 	   => "whois.domain-registry.nl",
	"no" 	   => "whois.norid.no",
	"nu" 	   => "whois.nic.nu",
	"nz" 	   => "whois.srs.net.nz",
	"pl" 	   => "whois.dns.pl",
	"pm" 	   => "whois.nic.pm",
	"pr" 	   => "whois.uprr.pr",
	"pt" 	   => "whois.dns.pt",
	"re" 	   => "whois.nic.re",
	"ro" 	   => "whois.rotld.ro",
	"ru" 	   => "whois.ripn.net",
	"sa" 	   => "whois.nic.net.sa",
	"sb" 	   => "whois.nic.net.sb",
	"sc" 	   => "whois2.afilias-grs.net",
	"se" 	   => "whois.iis.se",
	"sg" 	   => "whois.nic.net.sg",
	"sh" 	   => "whois.nic.sh",
	"si" 	   => "whois.arnes.si",
	"sk" 	   => "whois.ripe.net",
	"sm" 	   => "whois.ripe.net",
	"st" 	   => "whois.nic.st",
	"su" 	   => "whois.ripn.net",
	"tc" 	   => "whois.adamsnames.tc",
	"tf" 	   => "whois.nic.tf",
	"th" 	   => "whois.thnic.net",
	//"tj" 	   => "nic.tj",
	"tk" 	   => "whois.dot.tk",
	"tl" 	   => "whois.nic.tl",
	"tm" 	   => "whois.nic.tm",
	"tn" 	   => "whois.ripe.net",
	"to" 	   => "whois.tonic.to",
	"tp" 	   => "whois.nic.tl",
	"tr" 	   => "whois.nic.tr",
	"tv" 	   => "tvwhois.verisign-grs.com",
	"tw" 	   => "whois.twnic.net.tw",
	"ua" 	   => "whois.com.ua",
	"ug" 	   => "whois.co.ug",
	"uk" 	   => "whois.nic.uk",
	"us" 	   => "whois.nic.us",
	"uy" 	   => "nic.uy",
	"uz" 	   => "whois.cctld.uz",
	"va" 	   => "whois.ripe.net",
	"vc" 	   => "whois2.afilias-grs.net",
	"ve" 	   => "whois.nic.ve",
	"vg" 	   => "whois.adamsnames.tc",
	"wf" 	   => "whois.nic.wf",
	"ws" 	   => "whois.website.ws",
	"yt" 	   => "whois.nic.yt",
	"yu" 	   => "whois.ripe.net"
  );
  
  /** список для взятия целых частей доменов  */
  private $List_sub_domains = array(
   //украинские
   'biz.ua', 'co.ua', 'com.ua', 'edu.ua', 'gov.ua', 'in.ua', 'net.ua', 'org.ua',
   //украинские региональные
   'chernigov.ua', 
   'chernovtsy.ua', 
   'crimea.ua', 
   'ivano-frankivsk.ua',
   'kherson.ua', 
   'khmelnitskiy.ua', 
   'kiev.ua', 
   'kirovograd.ua', 
   'lutsk.ua',
   'poltava.ua', 
   'uzhgorod.ua', 
   'zaporizhzhe.ua', 
   'nikolaev.ua', 
   'odessa.ua',
   'rovno.ua', 
   'rv.ua', 
   'sebastopol.ua', 
   'sumy.ua', 
   'ternopil.ua', 
   'vinnica.ua',
   'zhitomir.ua',
   //другие
   'co.uk', 'org.uk', 'me.uk', 'eu.com', 'uk.com'	
  );
  /** домен */
  private $domain = '';
  /** сервер */
  private $whoisserver = '';
  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	     
   parent::__construct($AOwner, 'GenWhoisDomain', 'Whois owner info', 5);	 
  }//__construct  
    
  private function CheckForCorrect() {
   $this->domain = $this->strtolower($this->GetConnect()->url_real_host);
   if (!@preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $this->domain)) {
	if (!$this->GetConnect()->url_array_info) {
	 $this->SetError('Domain is not corrected!');
	 return false;	
	}	
   }
   return true;   	
  }//CheckForCorrect	    
  
  private function queryServer(){    
   $out = "";   
   $fp = @fsockopen($this->whoisserver, $this->port, $errno, $errstr, $this->timeout);
   @fputs($fp, $this->domain . "\r\n");
   while(!@feof($fp)) $out .= @fgets($fp);
   @fclose($fp);
   if(strlen($out)>0) return $out; else return false;
  }//queryServer
	  
  function ExecPlugin(ss_ConnectQuery &$Request) {	
   if (!$this->CheckForCorrect()) { return false; }
   $domainarray = array();
   //конкретно домен   
   if(!@preg_match('/(\d+).(\d+).(\d+).(\d+)/', $this->domain)){
	$domainarray = @preg_split("/\./", $this->domain);
	$domainarray = array_reverse($domainarray);
	$this->domain = $domainarray[1].'.'.$domainarray[0];
	if ((@count($domainarray) > 2) and ($domainarray[2] != '') and 
	(@in_array($this->domain, $this->List_sub_domains))) {
	 $this->domain = $domainarray[2].'.'.$this->domain;				
	}			
   }   
   //общая обработка - поиск
   foreach($this->whoisservers as $tld=>$server) {   									
	if($this->substr($this->domain, -$this->strlen($tld)) == $tld) {
 	 $this->whoisserver = $server;
	 break;
	}
   }   
   //проверка ip
   if (!$this->whoisserver) {
   	if (@preg_match('/(\d+).(\d+).(\d+).(\d+)/', $this->domain)) {
	 $this->whoisserver = "whois.arin.net"; 
	} else {
	 $this->SetError("Unknow whois server for {$this->domain}!");
	 return false;	 	
	}   	
   }
   //connect
   if ($res = $this->queryServer()) {
	@preg_match("/Whois Server: (.*)/", $res, $matches);
	$secondary = $matches[1];
	//requery
	if($secondary) {
	 $this->whoisserver = $secondary;
	 $res = $this->queryServer();
	}
	return $res;
   } 
   $this->SetError('No whois data found!');
   return false;      	
  }//ExecPlugin
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; }  
   	
 }//ss_Plugin_GenWhoisDomain
 //-----------------------------------------------------------------
 /** whois domain с выводом конкретной информации о данных */
 final class ss_Plugin_GenWhoisDomainEx extends ss_Plugin_GenTemplate {
  
  private $match_created = array(
   'domain registration date', 'creation date', 'record created on', 'created on', 'domain record activated', 
   'domain created', 'created', 'registered'
  );
  private $match_expired = array(
   'domain expiration date', 'expiration date','paid-till','domain expires on', 'domain expires',
   'record expires on', 'expires on'
  );
  private $nomatchfound  = array(
   'no match', //'no match for "%d"', 'no match for %d', 
   'no entries found', 'not found: %d', '~not found', 'nothing found'    
  );
  private $month_replased = array(
   'jan' => '01', 'feb' => '02',
   'mar' => '03', 'apr' => '04',
   'may' => '05', 'jun' => '06',
   'jul' => '07', 'aug' => '08',
   'sep' => '09', 'oct' => '10',
   'nov' => '11', 'dec' => '12'
  );
  private $days_list = array(
   'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'
  );
  private $match_registrar = array(
   'registrar of record is', 'registrant id', 'registrar', 'mnt-by', 'registrant'
  );
  private $match_statuses = array(
   'status', 'state'
  );
  private $match_owner = array(
   'registrant name', 'contact', 'org', 'person', 'e-mail'
  );
  private $results_fields = array(
   'createddate', 'expdate', 'registrar'
  ); 
  	  	
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenWhoisDomainEx', 'Whois owner contact', 5);	 
  }//__construct
  
  /** correct uanic date fornat, special function to decode all ather date formats  */
  private function GetUanicDate(&$s, &$res) {
    $s = $this->substr($s, 0, 8);	 
	if ($s && (strlen($s) == 8) && @is_numeric($s)) {
	 $res = @substr_replace(@substr_replace($s, "-", 4,0), "-", 7, 0);
    }
  }//GetUanicDate
  
  public function CorrectDateFormat($val, $data) {  
   $res = trim($data);
   $do_spaces = false;   
   //убираем дни
   foreach ($this->days_list as $day) {
	$res = @str_ireplace($day, '', $res);
	if ($res != $data) {
	 //убираем даты если по GMT
	 if ($this->stripos($res, 'gmt') !== false) {
	  $res = @preg_replace("/[\s][0-9]{2}:[0-9]{2}:[0-9]{2}[\s]*gmt/isU", ' ', $res);
	 }	 
	 $do_spaces = true;
	 break;	
	}	
   }   
   //обработка месяцев
   $losts = $res;
   foreach ($this->month_replased as $name => $value) {
	$res = @str_ireplace($name, $value, $res);
	if ($losts != $res) { break; }
   } 
   
   //проверка присутствия даты от украинских доменов  
   $s = '-uanic';
   $i = $this->stripos($res, $s);
   if ($i !== false) {   	
    $s = trim($this->substr($res, $i + $this->strlen($s)));    
	while ($this->strpos($s, ' ') !== false) { $s = @str_replace(' ', '', $s); }	
	if ($s != '') { $this->GetUanicDate($s, $res); }		
   }   
   //проверка и удаление всего, кроме даты
   while ($this->strpos($res, '  ') !== false) { $res = @str_replace('  ', ' ', $res); }
   if (@preg_match("/([0-9]{2,4}[^0-9a-z]+[0-9]{2,4}[^0-9a-z]+([0-9]+?))/isU", $res, $ar)) { 
   	$res = trim($ar[1]); 
   }
   $res = (!$do_spaces) ? @str_replace(' ', '', $res) : @str_replace(' ', '-', $res);   
   //начало
   if ($res == '') { return $res; } 
   foreach (array(':', '.', '/') as $repl) {
	$res = @str_replace($repl, '-', $res);
   }      
   if (@preg_match("/(\d{4}\-\d{2}\-\d{2})/isU", $res, $ar)) { return $res; }   
   $res1 = array('','','');
   $res1[0] = $this->StrFetch($res, '-');
   $s = $res;
   $res1[1] = $this->StrFetch($s, '-');
   $res1[2] = $s;   
   //если GMT - поменять даты
   $res = ($do_spaces && @is_numeric($res1[1]) && ($res1[1] > 12)) ? ($res1[2].'-'.$res1[0].'-'.$res1[1]) : 
   ($res1[2].'-'.$res1[1].'-'.$res1[0]);   
   //search alternate data source    
   if (@preg_match("/^([0-9]{8,16})/isU", @str_replace('-', '', trim($res)), $ar) && ($res = $ar[1])) {     
      $s = $res;
      $this->GetUanicDate($s, $res);    
   }//alt      
   return (!@preg_match("/(\d{4}\-\d{2}\-\d{2})/isU", $res, $ar)) ? '' : $res;
  }//CorrectDateFormat  
  
  protected function SearchForMatch($list, $source, $OnlyTextToEndLine=false) {
   $res = false;   
   foreach ($list as $val) {  
   	$ext_is_of = ($val == $this->match_registrar[0]) ? "[\s]" : "";         	
   	$ext = array(
	 "/[\r|\n][\s]*".$val."[\s]*:[\s]*([^\r\n]*?)[\r|\n]/isU"   
	);    	
	if (($this->substr($val, -2) == 'on') or ($ext_is_of != '')) {
	 $ext[] = "/".$ext_is_of.$val."[\s]+([^\r\n]*?)[\r|\n]/isU";	  	
	}
	foreach ($ext as $ext_item) {
     if (@preg_match($ext_item, $source, $ar)) { 
	  $data = trim($ar[1]);
	  if ($OnlyTextToEndLine) { return $data; }
	  return $this->CorrectDateFormat($val, $data);	 	
	 }	 	
	}	
   }   
   return $res;	
  }//SearchForMatch

  static function CheckCorrektDate2($date,$delim = '-') {
   if (trim($date) == '') { return false; }
   return ($delim == ':') ? @preg_match("/\d{1,2}\:\d{1,2}\:\d{1,2}/", $date) : 
    @preg_match("/\d{4}\-\d{2}\-\d{2}/", $date);	
  }//CheckCorrektDate2
    
  private function CheckCorrektDate($date,$delim = '-') {
   return self::CheckCorrektDate2($date, $delim);	
  }//CheckCorrektDate

  static function GetDateInN2($str) { 
  	$str .= ' 00:00:00';
 	$str_ = @explode(' ', $str); $str = $str_[0]; $str1 = $str_[1];
 	if (!self::CheckCorrektDate2($str_[0]) || !self::CheckCorrektDate2($str_[1],':')) { return -1; }	  	 	 	
 	$res = @explode('-',$str); $res1 = @explode(':',$str1);
	return @mktime($res1[0], $res1[1], $res1[2], $res[1], $res[2], $res[0]); 
  }//GetDateInN2
    
  private function GetDateInN($str) { 
   return self::GetDateInN2($str); 
  }//GetDateInN
  
  static function DateDiff2($interval, $date1, $date2, $time_data = 0) {
   if ($time_data > 0) { $timedifference = $time_data; } else { $timedifference = $date2 - $date1; }
   switch ($interval) {   	  	
   	case 'y':  $retval = bcdiv($timedifference, 86400*364, 0); break; //год
   	case 'm':  $retval = bcdiv($timedifference, 604800*4, 0); break; //месяц
    case 'w':  $retval = bcdiv($timedifference, 604800, 0); break; //неделя
    case 'd':  $retval = bcdiv($timedifference, 86400, 0); break; //день
    case 'h':  $retval = bcdiv($timedifference, 3600, 0); break; //час
    case 'n':  $retval = bcdiv($timedifference, 60, 0); break; //мин
    case 's':  $retval = $timedifference; break; //сек
   }
   return $retval;    
  }//DateDiff2    
  
  private Function DateDiff($interval,$date1,$date2,$time_data = 0) {
   return self::DateDiff2($interval, $date1, $date2, $time_data);
  }//DateDiff

  static function GetDateDiffInterval2($date1, $date2) {
   $date1 = trim($date1);
   $date2 = trim($date2);
   if (($date1 == '') or ($date2 == '')) { return false; }
   $date1 = self::GetDateInN2($date1);
   $date2 = self::GetDateInN2($date2);   
   if (($date1 == -1) or ($date2 == -1)) { return false; }
   $sec_interval = self::DateDiff2('s', $date1, $date2);
   if ($sec_interval < 60) { return $sec_interval.' сек'; }
   $result = '';   
   $year = self::DateDiff2('y',0,0,$sec_interval);
   if ($year > 0) {
    $result .= $year.' г';	
    $sec_interval = $sec_interval - (86400*364)*$year;
    if ($sec_interval <= 0) { return $result; }
   }
   $month = self::DateDiff2('m',0,0,$sec_interval);
   if ($month > 0) {
    $sec_interval = $sec_interval - (604800*4)*$month;	 
    if ($result != '') { if ($sec_interval <= 0) { $result .= ', '; } else { $result .= ', '; } }	
    $result .= $month.' мес';	
    if ($sec_interval <= 0) { return $result; }
   }
   $week = self::DateDiff2('w',0,0,$sec_interval);
   if ($week > 0) {
    $sec_interval = $sec_interval - 604800*$week;	
    if ($result != '') { /*if ($sec_interval <= 0) { $result .= ' и '; } else { */$result .= ', '; /*}*/ }	
    $result .= $week.' н';	
    if ($sec_interval <= 0) { return $result; }
   }    
   $day = self::DateDiff2('d',0,0,$sec_interval);
   if ($day > 0) {
    $sec_interval = $sec_interval - 86400*$day;	
    if ($result != '') { if ($sec_interval <= 0) { $result .= ', '; } else { $result .= ', '; } }	
    $result .= $day.' д';	
    if ($sec_interval <= 0) { return $result; }
   }  
   $hour = self::DateDiff2('h',0,0,$sec_interval);
   if ($hour > 0) {
    $sec_interval = $sec_interval - 3600*$hour;	
    if ($result != '') { if ($sec_interval <= 0) { $result .= ', '; } else { $result .= ', '; } }	
    $result .= $hour.' ч';	
    if ($sec_interval <= 0) { return $result; }
   }  
   $min = self::DateDiff2('n',0,0,$sec_interval);
   if ($min > 0) {
    $sec_interval = $sec_interval - 60*$min;	
    if ($result != '') { if ($sec_interval <= 0) { $result .= ', '; } else { $result .= ', '; } }	
    $result .= $min.' мин';	
    if ($sec_interval <= 0) { return $result; }
   }  
   if ($result != '') { $result .= ' и '; }
   $result .= $sec_interval.' сек';
   return $result;  	
  }//GetDateDiffInterval2
 
  private function GetDateDiffInterval($date1, $date2) {
   return self::GetDateDiffInterval2($date1, $date2);  	
  }//GetDateDiffInterval  
  
  protected function CheckForNoMatchFound(&$res) {
   //quick check for pass element	
   foreach ($this->results_fields as $field) {
	if ($field && isset($res[$field]) && $res[$field]) {
	 return $res;
	}
   } 
   //add-on elements
   $domain = $this->strtolower($this->GetConnect()->url_real_host);
   //action to check
   $data = $match_total = false;
   foreach ($this->nomatchfound as $word) {
   	if (!$word) { continue; }
	$word = @str_replace('%d', $domain, $word);
	if ($this->substr($word, 0, 1) == '~') {
	 $match_total = true;
	 $word = $this->substr($word, 1);	
	}
	//ok, follow to check
	if ($match_total && $data === false) { 
	 $data = @ltrim(@rtrim($this->strtolower($res['source']))); 
	}	 	
	//do it
	if (($match_total && $data == $word) || (!$match_total && $this->stripos($res['source'], $word) !== false)) {
	 //$res['source']  = 'No entries found';
	 $res['nofound'] = $domain;
	 break;	  	
	}	
   }
   return $res;	
  }//CheckForNoMatchFound
  
  protected function _DoGetFromDataText(ss_ConnectQuery &$Request, $value) {
   $params = $this->GetRunParams();
   $res = array('source' => $value);
   //check for non exists this domain
   if (!$params) { return $this->CheckForNoMatchFound($res); }
   //регистрация домена
   if (isset($params['createddate']) && $params['createddate']) {
	$res['createddate'] = $this->SearchForMatch($this->match_created, $value);
	$old = ($res['createddate']) ? $this->GetDateDiffInterval($res['createddate'], $this->GetThisDate()) : false;
	if ($old) { $res['domainold'] = DoEncodeDataToDef($old); }
	$old = ($res['createddate']) ? $this->DateDiff(
	 'd', $this->GetDateInN($res['createddate']), $this->GetDateInN($this->GetThisDate())
	) : false;
	if ($old) { $res['old_days'] = $old; }		
   } 
   //окончание регистрации
   if (isset($params['expdate']) && $params['expdate']) {
	$res['expdate'] = $this->SearchForMatch($this->match_expired, $value);
	$pass = ($res['expdate']) ? $this->DateDiff(
	 'd', $this->GetDateInN($this->GetThisDate()), $this->GetDateInN($res['expdate'])
	) : false;
	if ($pass !== false) { $res['pass'] = $pass; }	
   }
   //регистратор 
   if (isset($params['registrar']) && $params['registrar']) {
	$res['registrar'] = $this->SearchForMatch($this->match_registrar, $value, true);
   }
   //статус 
   if (isset($params['status']) && $params['status']) {
	$res['status'] = $this->SearchForMatch($this->match_statuses, $value, true);
   }   
   //владелец
   if (isset($params['owner']) && $params['owner']) {
	$res['owner'] = $this->SearchForMatch($this->match_owner, $value, true);
   }   
   return $this->CheckForNoMatchFound($res);        	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   /* пропарсить только текст, если таковы параметры */
   if (isset($params['data']) && $params['data']) {
	return $this->_DoGetFromDataText($Request, $params['data']);
   }
   //получить заново   	
   $error = '';
   $value = '';    
   $params2 = ($params && isset($params['cashonlythis']) && $params['cashonlythis']) ? array('ignorecach' => 1) : false;  
   return (!$this->GetConnect()->RunPluginEx(SS_WHOISDOMAIN, $error, $value, $params2)) ? $this->SetError($error) : 
   $this->_DoGetFromDataText($Request, $value);         	
  }//ExecPlugin
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; }  
  	
 }//ss_Plugin_GenWhoisDomainEx
 //-----------------------------------------------------------------
 /** whois ip сайта */
 final class ss_Plugin_GenWhoisIP extends ss_Plugin_GenTemplate {
  private $server = 'whois.arin.net';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenWhoisIP', 'Whois ip', 5);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {   	
   $ip = $this->GetConnect()->GetURLip();
   $host = @gethostbyaddr($ip);
   if (!$host) { return $this->SetError("Can't IP Whois without an IP address."); }
   if (!$sock = @fsockopen($this->server, 43, $num, $error, 20)) {
	 unset($sock);
	 return $this->SetError("Timed-out connecting to ".$this->server." (port 43)");
   }
   $buffer = '';
   @fputs($sock, $ip."\n");
   while (!@feof($sock)) {
    $buffer .= @fgets($sock, 10240);
   }
   @fclose($sock);
   $nextServer = false;
   $extra = '';
   if (@preg_match("/RIPE.NET/i", $buffer)) $nextServer = "whois.ripe.net";
   elseif (@preg_match("/whois.apnic.net/i", $buffer)) $nextServer = "whois.apnic.net";
   elseif (@preg_match("/nic.ad.jp/i", $buffer)) {
	$nextServer = "whois.nic.ad.jp";
 	$extra = "/e";
   } elseif (@preg_match("/whois.registro.br/i", $buffer)) $nextServer = "whois.registro.br";			
   if ($nextServer) {
	$buffer = "";
	if (!$sock = @fsockopen($nextServer, 43, $num, $error, 10))	{
	 unset($sock);
	 return $this->SetError("Timed-out connecting to $nextServer (port 43)");
	} else {
	 @fputs($sock, $ip.$extra."\n");
	 while (!@feof($sock)) {	
	  $buffer .= @fgets($sock, 10240); 
	 }  
	 @fclose($sock);
	}
   }
   return $buffer;    	
  }//ExecPlugin
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->GetURLip()));	
  }//GetCachURLmd5 
  
  function GetFlagUseLongData() { return true; }   
  	
 }//ss_Plugin_GenWhoisIP
 //----------------------------------------------------------------- 
 /** количество сайтов на ip */
 final class ss_Plugin_GenDomainsOnIP extends ss_Plugin_GenTemplate {
  const LINK_QUERY = 'http://www.bing.com/search?FORM=MSNH&q=IP:';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenDomainsOnIP', 'Количество сайтов на IP', 2);	 
  }//__construct  
  
  protected function _DoGetFromDataText(ss_ConnectQuery &$Request) {
   $data = @str_replace('&#160;', '', $Request->GetData());      
   $Ext = DoEncodeDataToDef("/ты[\s]*:[\s]*([^a-z><;:]+?)[of|из][\s]*([0-9\.\s,]+?)<[\s]*\//isU");
   if (@preg_match($Ext, $data, $ar)) {
   	//print_r($ar); exit;
    return $this->ParseRamblerTextResult($ar[2]);    
   }
   return 0;   	
  }//_DoGetFromDataText
  	
  function ExecPlugin(ss_ConnectQuery &$Request) {   	
   $connect = $this->GetConnect();
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY.$connect->GetURLip(), $type_number, $link_query)) {  
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;    	
  }//ExecPlugin  
  	
 }//ss_Plugin_GenDomainsOnIP
 //-----------------------------------------------------------------
 /** гео лаколизация ip */
 final class ss_Plugin_GenGeoLocaleIP extends ss_Plugin_GenTemplate {
  const LINK_QUERY = 'http://www.geoplugin.net/php.gp?base_currency=USD&ip=';	
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenGeoLocaleIP', 'Гео локализация ip', 2);	 
  }//__construct  
  
  protected function _DoGetFromDataText(ss_ConnectQuery &$Request) {
   return (!$res = @unserialize(@trim($Request->GetData()))) ? $this->SetError('Can`t get geo info') : $res;  	
  }//_DoGetFromDataText
  	
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   $ip = ($params && isset($params['ip']) && $params['ip']) ? $params['ip'] : $this->GetConnect()->GetURLip();
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY.$ip, $type_number, $link_query)) {  
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;    	
  }//ExecPlugin
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   $params = $this->GetRunParams();
   $ip = ($params && isset($params['ip']) && $params['ip']) ? $params['ip'] : $this->GetConnect()->GetURLip();	
   return @md5($ip);	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; }  
  	
 }//ss_Plugin_GenGeoLocaleIP
 //-----------------------------------------------------------------	
 /** цена ссылки с главной по тиц, пр и ув */
 final class ss_Plugin_GenLinkPriceWUV extends ss_Plugin_GenTemplate {	
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenLinkPriceWUV', 'Цена ссылки с главной', -1);	 
  }//__construct  
  
  private function GetPluginInfo($id) {
   $value = false;	
   if (!$this->GetConnect()->RunPluginEx($id, $error, $value)) {
    return $this->SetError($error);	
   }
   if (!$value || !isset($value['value'])) { return $this->SetError('Can`t get info: '.$id); }
   return $value['value'];   	
  }//GetPluginInfo
  	
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   $res = array('cy' => -1, 'pr' => -1, 'uv' => 1);
   $usprice = 30; $rto = 2; $tous = 1;
   if ($params) {
	if (isset($params['cy']) && @is_numeric($params['cy'])) $res['cy'] = $params['cy'];
	if (isset($params['pr']) && @is_numeric($params['pr'])) $res['pr'] = $params['pr'];
	if (isset($params['uv']) && @is_numeric($params['uv'])) $res['uv'] = $params['uv'];
	if (isset($params['usprice']) && @is_numeric($params['usprice'])) $usprice = $params['usprice'];
	if (isset($params['rto']) && @is_numeric($params['rto'])) $rto = $params['rto'];
	if (isset($params['tousd']) && @is_numeric($params['tousd'])) $tous = $params['tousd'];	
   }   
   $res['cy'] = ($res['cy'] < 0) ? $this->GetPluginInfo(SS_YANDEXCY) : $res['cy'];
   $res['pr'] = ($res['pr'] < 0) ? $this->GetPluginInfo(SS_GOOGLEPR) : $res['pr'];
   if (($res['cy'] === false) || ($res['pr'] === false)) { return false; }   
   switch ($res['uv']) {
	case 3: $res = $res['pr'] * 3.73 + $res['cy'] * 0.005732 + 0.8087;  break;
	case 2: $res = $res['pr'] * 9.44 + $res['cy'] * 0.003277 + 1.6;     break;
	default : $res = $res['pr'] * 20.773 + $res['cy'] * 1.12832 + 8.18;	break;
   } 
   if ($res < 0) { $res = 0; }
   return ($tous && $res) ? @round($res / $usprice, $rto) : $res;  	
  }//ExecPlugin
  
  function GetFlagUseLongData() { return true; }  
  	
 }//ss_Plugin_GenLinkPriceWUV
 //-----------------------------------------------------------------
 /** ссылки страницы */
 final class ss_Plugin_GenPageLinksList extends ss_Plugin_GenTemplate {	
  private $fetch_proc = false;
  private $temp_list = array();
  private $test_href = '';
  private $noindex_list = false;  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenPageLinksList', 'Ссылки страницы', -1);	 
  }//__construct
  
  private function CheckDoubleListen($href) {
   $params = $this->GetRunParams();
   if ($params && isset($params['ignoredoubled']) && !$params['ignoredoubled']) { return true; }
   $href = trim($this->strtolower($href));
   if ($href == $this->test_href) {	$href = $this->substr($href, 0, -1); }
   if (@in_array($href, $this->temp_list)) { return false; }
   $this->temp_list[] = $href;
   return true;   	
  }//CheckDoubleListen 
  
  protected function CombineNoIndexList($params) {
   $this->noindex_list = false;
   if ($params && isset($params['checknoindex']) && !$params['checknoindex']) { return false; }
   $p = new ss_HTMLTagParser();
   $p->DeleteSpecialBloks = true;
   $p->use_regext_preg_to_search = true;
   $this->GetConnect()->SetParserTag('noindex', $p);
   while ($p->GetTag()) {
	if ($p->TagPosition >= 0) {
	 if (!$this->noindex_list) { $this->noindex_list = array(); }	
	 $this->noindex_list[] = array(
	  'from'   => $p->TagPosition,
	  'length' => $p->TagSourceLength,
	  'to'     => $p->TagPosition + $p->TagSourceLength
	 );		
	} 	
   }   
   unset($p);	
  }//CombineNoIndexList
  
  protected function CheckForNoIndexItem(ss_HTMLTagParser $p) {
   if ($p && $this->noindex_list && $p->TagPosition >= 0 && $p->TagPosition) {
	foreach ($this->noindex_list as $item) {
	 if ($item['from'] < $p->TagPosition && $item['to'] > $p->TagPosition + $p->TagSourceLength) { return true; }	
	}	
   }
   return false;   	
  }//CheckForNoIndexItem
  
  protected function CheckForNoFollowParam(ss_HTMLTagParser $p, $params) {
   if (!$p || !$p->TagParamsSource || ($params && isset($params['checknofol']) && !$params['checknofol'])) { return false; }
   $rel = $p->GetParamValue('rel');
   return $rel && @in_array('NOFOLLOW', @explode(',', $this->strtoupper(@str_replace(' ', '', $rel))));   	
  }//CheckForNoFollowParam 
  	
  protected function CorrectLinkHref($href) {
   //$this->GetConnect()- 
   	
  }//CorrectLinkHref
  	
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   $this->fetch_proc = ($params && isset($params['fetch_proc'])) ? $params['fetch_proc'] : false;
   $this->CombineNoIndexList($params);
   $p = new ss_HTMLTagParser();
   $p->DeleteSpecialBloks = true;
   if ($params && isset($params['usestrongregext']) && $params['usestrongregext']) {
    $p->use_regext_preg_to_search = true;	
   }
   if ($params && isset($params['source'])) {
    $p->SetData($params['source'], 'a');	
   } else {
   	$this->GetConnect()->SetParserTag('a', $p);		
   }
   $action = true;
   $res = array();
   $this->test_href = $this->strtolower($this->GetConnect()->url_protocol.'://'.$this->GetConnect()->url_host).'/';   
   while ($action && $p->GetTag()) {
	//проверка присутствия параметра href	
	$href  = $p->GetParamValue('href');	
	if ($href === false) { continue; }
	$text  = $p->GetParamValue('');	
	if (!$params || !isset($params['strip_tags_in_text']) || $params['strip_tags_in_text']) {	
	 while($text != @strip_tags($text)) {
	  $text = @strip_tags($text);
	 }
	}	
	//ссылка получена, корректировка
	$href_correct = $this->GetConnect()->CorrectLinkToHostAndPort(
	 $this->GetConnect()->url_host, $this->GetConnect()->url_protocol, 
	 $this->GetConnect()->url_self, $href, ($params && isset($params['ignoreresh']) && $params['ignoreresh']),
	 (!$params || !isset($params['getonlyhost']) || $params['getonlyhost']) 
	);
	if (!$href_correct || !$this->CheckDoubleListen($href_correct)) { continue; }	
	//тип ссылки
	$href_type = $this->GetConnect()->GetLinkType($this->GetConnect()->url_host, $href_correct);
	//проверка фильтра
	if ($params) {
	 if (($href_type == SS_IK_LINK_INSIDE) && isset($params['noinside']) && $params['noinside']) { 
	  continue; 
	 } elseif (($href_type == SS_IK_LINK_OUTSIDE) && isset($params['nooutside']) && $params['nooutside']) { 
	  continue;
	 } elseif (($href_type == SS_IK_LINK_SUBDOM) && isset($params['nosubdom']) && $params['nosubdom']) {
	  continue;	
	 }
	}	
	$noindex  = $this->CheckForNoIndexItem($p);
	$nofollow = $this->CheckForNoFollowParam($p, $params);
	//проверка обработки пользователем
	if ($this->fetch_proc !== false) {
	 switch (@call_user_func(
	   $this->fetch_proc, $this, $p, $href, $href_correct, $href_type, $text, $noindex, $nofollow  
	  )) {
	  case 0: $action = false; break;
	  case 2: continue;
	  default : break;	  	
	 }	 	
	}
	if (!$action) { break; }
	$named = 'error';
	switch ($href_type) {
	 case SS_IK_LINK_ERROR:   $named = 'errors'; break;
	 case SS_IK_LINK_INSIDE:  $named = 'inside'; break;
	 case SS_IK_LINK_OUTSIDE: $named = 'outside'; break;
	 case SS_IK_LINK_SUBDOM:  $named = 'subdom'; break;	 	
	}
    
    if ($href == 'http:' || $href == 'http') continue;
        
	$res[$named][] = array(
	 'href'      => $href, 
	 'href_full' => $href_correct, 
	 'text'      => $text, 
	 'noindex'   => $noindex, 
	 'nofollow'  => $nofollow
	);
	if (isset($res[$named.'_info']['index'])) { if (!$nofollow && !$noindex) { $res[$named.'_info']['index']++; } } else {
	 $res[$named.'_info']['index'] = (!$nofollow && !$noindex) ? 1 : 0;
	}
	if (isset($res[$named.'_info']['noindex'])) { if ($nofollow || $noindex) { $res[$named.'_info']['noindex']++; } } else { 
	 $res[$named.'_info']['noindex'] = ($nofollow || $noindex) ? 1 : 0; 
	}
	if (isset($res[$named.'_info']['all'])) { $res[$named.'_info']['all']++; } else { $res[$named.'_info']['all'] = 1; }
   }   
   return $res;  	
  }//ExecPlugin
  
  function GetFlagUseLongData() { return true; }  
  	
 }//ss_Plugin_GenPageLinksList
 //-----------------------------------------------------------------
 /** изображения страницы */
 final class ss_Plugin_GenPageImagesList extends ss_Plugin_GenTemplate {	
  private $fetch_proc = false;
  private $temp_list = array();  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GenPageImagesList', 'Изображения страницы', -1);	 
  }//__construct
  
  private function CheckDoubleListen($href) {
   $params = $this->GetRunParams();
   if ($params && isset($params['ignoredoubled']) && !$params['ignoredoubled']) { return true; }
   $href = trim($this->strtolower($href));
   if (@in_array($href, $this->temp_list)) { return false; }
   $this->temp_list[] = $href;
   return true;   	
  }//CheckDoubleListen  
  	
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   $this->fetch_proc = ($params && isset($params['fetch_proc'])) ? $params['fetch_proc'] : false;
   $p = new ss_HTMLTagParser();
   $p->DeleteSpecialBloks = true;
   if ($params && isset($params['usestrongregext']) && $params['usestrongregext']) {
    $p->use_regext_preg_to_search = true;	
   }
   if ($params && isset($params['source'])) {
    $p->SetData($params['source'], 'img');	
   } else {
   	$this->GetConnect()->SetParserTag('img', $p);		
   }
   $action = true;
   $res = array();   
   while ($action && $p->GetSympleTag()) {
	//проверка присутствия параметра src
	$href  = $p->GetParamValue('src');
	if ($href === false) { continue; }
	$text   = $p->GetParamValue('alt');
	$width  = $p->GetParamValue('width');
	$height = $p->GetParamValue('height');	
	//ссылка получена, корректировка
	$href_correct = $this->GetConnect()->CorrectLinkToHostAndPort(
	 $this->GetConnect()->url_host, $this->GetConnect()->url_protocol, 
	 $this->GetConnect()->url_self, $href, false, true 
	);
	if (!$href_correct || !$this->CheckDoubleListen($href_correct)) { continue; }	
	//тип ссылки
	$href_type = $this->GetConnect()->GetLinkType($this->GetConnect()->url_host, $href_correct);
	//проверка фильтра
	if ($params) {
	 if (($href_type == SS_IK_LINK_INSIDE) && isset($params['noinside']) && $params['noinside']) { 
	  continue; 
	 } elseif (($href_type == SS_IK_LINK_OUTSIDE) && isset($params['nooutside']) && $params['nooutside']) { 
	  continue;
	 } elseif (($href_type == SS_IK_LINK_SUBDOM) && isset($params['nosubdom']) && $params['nosubdom']) {
	  continue;	
	 }
	}	
	//проверка обработки пользователем
	if ($this->fetch_proc !== false) {
	 switch (@call_user_func($this->fetch_proc, $this, $p, $href, $href_correct, $href_type, $text, $width, $height)) {
	  case 0: $action = false; break;
	  case 2: continue;
	  default : break;	  	
	 }	 	
	}
	if (!$action) { break; }
	$named = 'error';
	switch ($href_type) {
	 case SS_IK_LINK_ERROR:   $named = 'errors'; break;
	 case SS_IK_LINK_INSIDE:  $named = 'inside'; break;
	 case SS_IK_LINK_OUTSIDE: $named = 'outside'; break;
	 case SS_IK_LINK_SUBDOM:  $named = 'subdom'; break;	 	
	}
	$arr = array('src'=>$href, 'src_full'=>$href_correct);
	if ($text !== false) { $arr['alt'] = $text; }
	if ($width !== false) { $arr['width'] = $width; }
	if ($height !== false) { $arr['height'] = $height; }	
	$res[$named][] = $arr;	
   }   
   return $res;  	
  }//ExecPlugin  
  	
 }//ss_Plugin_GenPageImagesList
 //-----------------------------------------------------------------
 /** анализ контента */
 final class ss_Plugin_ActionContentAnalize extends ss_Plugin_GenTemplate {		  
  private $res = false;
  private $stopwords = null;
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'ActionContentAnalize', 'Анализ контента страницы', 5);	 
  }//__construct 	
  	
  /** количество вхождений */
  protected function GetIncludeCount($str, $word, $limit=0) {
   $word = @trim($word);
   if (!$str || !$word) { return 0; }
   $str = " $str "; $word = " $word ";
   $result = 0;
   $i = $this->stripos($str, $word);   
   while ($i !== false) {
   	$result++;
   	$i+=($this->strlen($word) - 1);   	
	$i = $this->stripos($str, $word, $i);
	if ($limit > 0 && $result >= $limit) { return $result; } 
   }
   return $result;
  }//GetIncludeCount
  
  /** корректировка строки для парсинга слов */
  protected function PrepereStringToWordList($str, $separator=" ") {
   if ($separator == ' ') { $separator = ''; }
   if ($separator) { $str = @str_replace($separator, " $separator ", $str); }   	 
   return $this->GetConnect()->ClearElementsInText($str, $separator); 	
  }//PrepereStringToWordList
  
  /** обработка слов текста */
  protected function ActionStepToWords($str, $blockname, $func, $docleartext=true, $separator=" ") {
   $str1 = ($docleartext) ? $this->PrepereStringToWordList($str, $separator) : $str;
   $str  = $str1;
   $wordscount = $this->GetWordsCountInText($str, $separator);
   $word = $this->StrFetch($str1, $separator);
   while ($word || $str1) {
	$word = @trim($word);
	if ($word) { 	 
	 //@call_user_func(array($this, $func), $word, $str, $wordscount, $blockname, $separator);	 
	 $this->$func($word, $str, $wordscount, $blockname, $separator); 	
	}	
	$word = $this->StrFetch($str1, $separator);
   }
   //релеантность кконтенту страницы
   if (isset($this->res[$blockname]['relevanttocontent'])) {
	$this->res[$blockname]['relevanttocontent'] = ($this->res[$blockname]['wordscount'] <= 0) ? 0.00 : 	
	@round(($this->res[$blockname]['fullrepeatincontent'] * 100) / $this->res[$blockname]['wordscount'], 3);	
   }    
   return $str;  	
  }//ActionStepToWords
  
  /** количество слов в тексте */
  protected function GetWordsCountInText($str, $separator=" ") {
   while (@$this->strpos($str, "  ") !== false) { $str = @str_replace("  ", " ", $str); }
   $str = @trim($str);
   if (!$str) { return 0; }
   if ($this->substr($str, 0, 1) == $separator) { $str = $this->substr($str, 1); }
   if ($this->substr($str, -1) == $separator) { $str = $this->substr($str, 0, -1); }
   $count = $this->substr_count($str, $separator);
   return (!$count) ? 1 : ($count + 1);   	
  }//GetWordsCountInText
  
  /** обработка контента страницы, возврат одного элемента */
  protected function _ActionContentWords($word, $str, $wordscount, $blockname, $separator) {
   $this->res[$blockname]['allwordscount']++;	
   $is_stopword = $this->stopwords->CheckWord($word);
   if ($is_stopword) {
	$this->res[$blockname]['stopwordscount']++;
	$this->res[$blockname]['stopwordslist'][] = $word;
	return true;	
   }
   $wordscount = (!$wordscount || $wordscount < 0) ? 1 : $wordscount;
   //добавить слово в текст
   if (!$this->res['pageinfo']['textnostopwords']) { 
   	$this->res['pageinfo']['textnostopwords'] = $word; 
   } else {
    $this->res['pageinfo']['textnostopwords'] .= (($separator == " ") ? " $word" : "$separator $word");	
   }
   //всего слов
   $this->res[$blockname]['wordscount']++;
   //обработка слова
   $word1 = $this->strtolower($word);
   if (!isset($this->res[$blockname]['wordslist'][$word1])) {
    $word_item = array('word' => $word);
    $word_item['inputs'] = $this->GetIncludeCount($str, $word);   
    $word_item['tfherz'] = @round($word_item['inputs'] / $wordscount, 3); //TF(Term Frequency)
    $this->res[$blockname]['wordslist'][$word1] = $word_item;
    $this->res[$blockname]['wordsnorepeatnostopwords']++; 
   }
   return true;       	
  }//_ActionContentWords  
  
  /** анализ любого тэга, отличного от body */
  protected function _ActionTagWords($word, $str, $wordscount, $blockname, $separator) {
   $this->res[$blockname]['allwordscount']++; 
   $is_stopword = $this->stopwords->CheckWord($word);
   if ($is_stopword) {
	$this->res[$blockname]['stopwordscount']++;
	$this->res[$blockname]['stopwordslist'][] = $word;
	return true;	
   }
   $wordscount = (!$wordscount || $wordscount < 0) ? 1 : $wordscount;
   //добавить слово в текст
   if (!$this->res[$blockname]['textnostopwords']) { 
   	$this->res[$blockname]['textnostopwords'] = $word; 
   } else {
    $this->res[$blockname]['textnostopwords'] .= (($separator == " ") ? " $word" : "$separator $word");	
   }
   //всего слов
   $this->res[$blockname]['wordscount']++;
   //обработка слова
   $word1 = $this->strtolower($word);
   if (!isset($this->res[$blockname]['wordslist'][$word1])) {
    $word_item = array('word' => $word);
    $word_item['inputs'] = $this->GetIncludeCount($str, $word);
	$word_item['inputs_in_content'] = $this->GetIncludeCount($this->res['pageinfo']['text'], $word);  
    $word_item['tfherz'] = @round($word_item['inputs'] / $wordscount, 3);
    if ($this->res['contentinfo']['allwordscount']) {
     $word_item['plotnost'] = @round(($word_item['inputs_in_content'] * 100) / $this->res['contentinfo']['allwordscount'], 3);
    } else { $word_item['plotnost'] = 0.00; } 
    $this->res[$blockname]['wordslist'][$word1] = $word_item;
    $this->res[$blockname]['wordsnorepeatnostopwords']++; 
   }
   //общая плотность
   $this->res[$blockname]['fullplotnost']+=$word_item['plotnost'];
   //общее количество вхождений (количество слов с вхождением)
   if ($word_item['inputs_in_content']) { $this->res[$blockname]['fullrepeatincontent']++; }
   //слов с неоднократным повтором
   if ($word_item['inputs'] > 1) { $this->res[$blockname]['wordscountinrepeatin']++; }   
   return true;     	
  }//_ActionTagWords  
  	
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   $this->stopwords = new ss_StopWords_obj();
   $this->res = array(
    /* информация о сайте */
    'pageinfo' => array(
	  //размер страницы
	  'size'         => $this->GetConnect()->GetDataSizeStr($this->GetConnect()->res_url_size),
	  //время загрузки
	  'time'         => $this->GetConnect()->res_time_query,
	  //скорость загрузки
	  'speed'        => $this->GetConnect()->GetSpeedAsStr($this->GetConnect()->res_load_speed),
	  //кодировка страницы
	  'encode'       => $this->GetConnect()->GetEncodeName(),
	  //ip сайта
	  'ip'           => $this->GetConnect()->GetURLip(),
	  //текс страницы без тэгов
	  'text'         => $this->GetConnect()->GetSimplyTextFromPage(),
	  //всего символов, вместе с html тэгами
	  'charscount'   => $this->GetConnect()->GetDataLength(),
	  //ссылка анализа
	  'linkcheck'    => $this->GetConnect()->url_self,
	  //ссылка анализа без протокола
	  'linknorot'    => $this->GetConnect()->url_self_no_protocol,
	  //перенаправление
	  'redirectto'   => $this->GetConnect()->res_redirect_link,
	  //хост сайта
	  'host'         => $this->GetConnect()->url_host,
	  //html код
	  'htmldata'     => $this->HTMLspecialChars($this->GetConnect()->GetData()),
	  //ответ сервера
	  'headresponse' => $this->GetConnect()->res_header_source
	)	
   );
   /* количество символов только текста страницы */
   $this->res['pageinfo']['textcount'] = $this->strlen($this->res['pageinfo']['text']);
   /* текст без пробелов */
   $this->res['pageinfo']['textnospace'] = @str_replace(" ", "", $this->res['pageinfo']['text']);
   /* длина текста без пробелов */
   $this->res['pageinfo']['nospcount'] = $this->strlen($this->res['pageinfo']['textnospace']);
   /* доля текста без тэгов к всему содержимому страницы */
   $this->res['pageinfo']['compereto'] = ($this->res['pageinfo']['charscount'] == 0) ? 0 : 
   @round(($this->res['pageinfo']['textcount'] * 100) / $this->res['pageinfo']['charscount'], 2);
   
   /* текст страницы */
   $this->res['contentinfo'] = array(
    //список слов
    'wordslist' => array(),
    //количество стоп-слов
    'stopwordscount' => 0,
    //список стоп-слов в тексте
    'stopwordslist' => array(),
    //всего слов в тексте
    'wordscount' => 0,
    //всего слов (и стоп-слов и нет)
    'allwordscount' => 0,
    //слов без повторов и стоп-слов
    'wordsnorepeatnostopwords' => 0
   );
   $this->res['pageinfo']['textnostopwords'] = '';
   $this->ActionStepToWords($this->res['pageinfo']['text'], 'contentinfo', '_ActionContentWords', false);

   /* список анализируемых тэгов */
   $tags_listen = array(
    /* тэг титл */
    'titleinfo' => array(
     //текст тэга
	 'text'       => $this->GetConnect()->GetTitle(),
	 //разделитель слов
	 'separator'  => ' ',
	 //имя тэга
	 'tagname' => 'title'
	),
	
	/* тэг keywords */
    'keywordsinfo' => array(
     //текст тэга
	 'text'       => $this->GetConnect()->GetKeyWords(),
	 //разделитель слов
	 'separator'  => ($params && isset($params['keywordsbyspace']) && $params['keywordsbyspace']) ? ' ' : ',',
	 //имя тэга
	 'tagname' => 'keywords'
	)
   );
   
   /* добавить тэги из параметров */
   if ($params && isset($params['gettagssource']) && $params['gettagssource']) {
	foreach ($params['gettagssource'] as $pid => $value) {	
	 $name = $value['name'];	
	 $arr = array(
	  //разделитель
	  'separator' => (isset($value['separ']) ? $value['separ'] : ' '),
	  //имя тэга
	  'tagname'   => $name
	 );	 
	 //текст тэга
	 if (!$value['ones']) { $arr['text'] = $this->GetConnect()->GetFirstTag($name); } 
	 elseif (isset($value['nameAttr']) && isset($value['valueAttr']) && isset($value['nameValue'])) {
	  $arr['text'] = $this->GetConnect()->GetTagEx($name, $value['nameValue'], $value['nameAttr'], $value['valueAttr']);	   	
	 }	 
	 //имя блока в результате
	 $attr_name = (isset($value['id']) && $value['id']) ? $value['id'] : ('tag_'.$name.
	 (($value['ones'] && @is_array($value['nameValue'])) ? @implode('', $value['nameValue']) : 
	 (($value['ones']) ? $value['nameValue'] : ''))); 
	 //ok
	 if (isset($arr['text']) && $arr['text'] !== false) {
	  //добавить на анализ	
	  if ($value['action']) { $tags_listen[$attr_name] = $arr; } else {
	   //добавить в результат получения содержимого
	   $this->res[$attr_name] = array(
	    'name' => $arr['tagname'],
	    'data' => $arr['text']
	   );	  	
	  }		
	 } 	
	}	
   }
   
   /* анализ выбранных тэгов */
   foreach ($tags_listen as $name_block => $item) {
	if ($item['text'] !== false) {
      $this->res[$name_block] = array(
       //имя тэга
       'tagname' => $item['tagname'],
       //текст
       'text'   => $item['text'],
       //текст без отформатированный под перебор слов
       'textclear' => $this->PrepereStringToWordList($item['text'], $item['separator']),
       //текст без стоп-слов
       'textnostopwords' => '',
	   //всего слов в заголовке включая стоп-слова
	   'allwordscount' => 0,
	   //количество стоп-слов
       'stopwordscount' => 0,
	   //список стоп-слов в тексте
       'stopwordslist' => array(),
	   //всего слов в тексте
       'wordscount' => 0,
	   //слов без повторов и стоп-слов
       'wordsnorepeatnostopwords' => 0,
       //общая плотность всех слов к контенту
       'fullplotnost' => 0,
       //релевантность к контенту
       'relevanttocontent' => 0,
	   //общее количество повторов в контенте
	   'fullrepeatincontent' => 0,
	   //количество слов в тэге с количеством повторов больше 1
	   'wordscountinrepeatin' => 0,       
       //список слов
	   'wordslist' => array()   
      );
      $this->ActionStepToWords($this->res[$name_block]['textclear'], $name_block, '_ActionTagWords', false, $item['separator']);
	}	
   }
   
   //завершение, доработка контента
   if ($this->res['contentinfo']['wordslist']) {
	foreach ($this->res['contentinfo']['wordslist'] as &$word) {	 
	 //в title	
	 $word['intitle'] = (!isset($this->res['titleinfo'])) ? 0 : 
	 $this->GetIncludeCount($this->res['titleinfo']['textclear'], $word['word'], 1);
	 //в keywords
	 $word['inkeywords'] = (!isset($this->res['keywordsinfo'])) ? 0 : 
	 $this->GetIncludeCount($this->res['keywordsinfo']['textclear'], $word['word'], 1);	 	
	}	
   }      
   //unset($this->stopwords);
   return $this->res;
  }//ExecPlugin
  
  function GetFlagUseLongData() { return true; }  
  	
 }//ss_Plugin_ActionContentAnalize
 //-----------------------------------------------------------------
 /** статистика посещений сайта по Live Internet */
 final class ss_Plugin_ActionLIstatSite extends ss_Plugin_GenTemplate {
  const LINK_QUERY = 'http://counter.yadro.ru/values?site=[url_real_host_no_www]';
  const LINK_IMAGE_LI = 'http://counter.yadro.ru/logo;[url_real_host_no_www]//?29.20';
  const LINK_TO_VIEW = 'http://www.liveinternet.ru/stat/[url_real_host_no_www]/';			  
  private $res = false;
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'ActionLIstatSite', 'Статистика посещения по Live Internet', 1);	 
  }//__construct
  
  protected function GetValueLI($ident, ss_ConnectQuery &$Request) {
   $Ext = '[\s]*=[\s]*([0-9]+?)[\s]*;/is';      
   return (@preg_match("/$ident".$Ext, $Request->GetData(), $ar)) ? (($ar[1] == '') ? false : $ar[1]) : false;   	
  }//GetValueLI 	
  	 	
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();   
   if (!$Request->RequestGET($this->GetConnect()->ReplaceCorrect(self::LINK_QUERY))) {
    return $this->SetError($Request->res_error);
   }   
   $this->res = array();
   if (($val = $this->GetValueLI('li_day_vis', $Request)) !== false) { $this->res['LiDayStatistic'] = $val; }
   if (($val = $this->GetValueLI('li_today_vis', $Request)) !== false) { $this->res['LiToDayStatistic'] = $val; }
   if (($val = $this->GetValueLI('li_week_vis', $Request)) !== false) { $this->res['LiWeekStatistic']   = $val; }
   if (($val = $this->GetValueLI('li_month_vis', $Request)) !== false) { $this->res['LiMonthStatistic'] = $val; }   
   return $this->res;
  }//ExecPlugin
  
  function GetFlagUseLongData() { return true; }
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5  
  	
 }//ss_Plugin_ActionLIstatSite
 //----------------------------------------------------------------- 
 /** анализ сайта */
 final class ss_Plugin_ActionURLAnalize extends ss_Plugin_GenTemplate {		  
  private $res = false;
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'ActionURLAnalize', 'Анализ сайта', 5);	 
  }//__construct 	
  	 	
  protected function CorrectKeyWordsList($s) {  
   if (@$this->strpos($s, ',') === false) return $s;   
   return @preg_replace('/([,])([^\r\s\n])/su', '$1 $2', $s); 
  }//CorrectKeyWordsList
        
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();  
   $this->res = array(
    /* информация о сайте */
    'pageinfo' => array(
	  //размер страницы
	  'size'         => $this->GetConnect()->GetDataSizeStr($this->GetConnect()->res_url_size),
	  //время загрузки
	  'time'         => $this->GetConnect()->res_time_query,
	  //скорость загрузки
	  'speed'        => $this->GetConnect()->GetSpeedAsStr($this->GetConnect()->res_load_speed),
	  //кодировка страницы
	  'encode'       => $this->GetConnect()->GetEncodeName(),
	  //ip сайта
	  'ip'           => $this->GetConnect()->GetURLip(),
	  //перенаправление
	  'redirectto'   => $this->GetConnect()->res_redirect_link,
	  //список перенаправлений
	  //'redirlist'    => $this->GetConnect()->res_redirect_list,
	  //хост сайта
	  'host'         => $this->GetConnect()->url_host,
	  //real host
	  'realhost'     => $this->GetConnect()->url_real_host,
	  //html код
	  'htmldata'     => $this->HTMLspecialChars($this->GetConnect()->GetData()),
	  //ответ сервера
	  'headresponse' => $this->GetConnect()->res_header_source,
	  //заголовок
	  'title'        => $this->GetConnect()->GetTitle(),
	  //ключевые слова
	  'keywords'     => $this->CorrectKeyWordsList($this->GetConnect()->GetKeyWords()),
	  //тэг h1
	  'h1tag'        => $this->GetConnect()->GetHTag(),
	  //описание
	  'description'  => $this->GetConnect()->GetDescription(),
	  //сервер хостинга
	  'res_server'   => $this->GetConnect()->res_server
	)	
   );
   //сервер
   $this->res['pageinfo']['server'] = $this->GetConnect()->GetIPServer($this->res['pageinfo']['ip']);
   //файл robots.txt
   $Request->connect_specidy_encoded_page = $this->GetConnect()->GetEncodeName();
   if ($Request->RequestGET($this->GetConnect()->url_host.'/robots.txt')) {
	$this->res['pageinfo']['robots'] = @ltrim($Request->GetData());
   }
   $Request->connect_specidy_encoded_page = false;
   //расположение сервера
   $res = $error = '';
   if ($this->GetConnect()->RunPluginEx(SS_GEOLOCALEIP, $error, $res, array('ip' => $this->res['pageinfo']['ip']))) {
	$this->res['pageinfo']['servergeo'] = $res['geoplugin_countryName'];	
   }
   //яндекс тиц
   $this->res['cyvalue'] = ($this->GetConnect()->RunPluginEx(SS_YANDEXCY, $error, $res)) ? $res : array();
   //google pr
   $this->res['prvalue'] = ($this->GetConnect()->RunPluginEx(SS_GOOGLEPR, $error, $res)) ? $res : array();
   //alexa traffic
   $par = array('w'=>180, 'h'=>100);
   $this->res['alexavalue'] = ($this->GetConnect()->RunPluginEx(SS_ALEXARANK, $error, $res, $par)) ? $res : array();
   //статистика по LI
   $this->res['LIvalue'] = ($this->GetConnect()->RunPluginEx(SS_SITESTATISTICSLI, $error, $res)) ? $res : array();
   //прогноз заработка
   $res = 10;
   if (!$this->res['cyvalue'] || $this->res['cyvalue']['value'] === false) { $res = 10; } 
   elseif ($this->res['cyvalue']['value'] >= 10 && $this->res['cyvalue']['value'] <= 30) { $res = 50; } 
   elseif ($this->res['cyvalue']['value'] > 30 && $this->res['cyvalue']['value'] <= 60) { $res = 100; }
   else { $res = 150; }
   $this->res['pageinfo']['getmoneyfromb'] = $res;   
   
   return $this->res;
  }//ExecPlugin
  
  function GetFlagUseLongData() { return true; }
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5  
  	
 }//ss_Plugin_ActionURLAnalize
 //-----------------------------------------------------------------
 /** генератор ключевых слов */
 final class ss_Plugin_ActionKeywordsGenerator extends ss_Plugin_GenTemplate {		  
  private $res = false;
  private $stopwords = null;
  private $source = '';
  private $separator = ', ';
  private $usecount = 18;
  private $minlenght = 3;
  private $array_modified = false;
  private $allcount = 1000;
  private $tempsource = '';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'ActionKeywordsGenerator', 'Генератор ключевых слов', -1);	 
  }//__construct
  
  /** проверка на стоп-слово */
  protected function CheckForStopWord($word) {
   $params = $this->GetRunParams();
   if (!$params || !isset($params['ignorestopwords']) || !$params['ignorestopwords']) { return false; }
   if (!$this->stopwords) { $this->stopwords = new ss_StopWords_obj(); }
   return $this->stopwords->CheckWord($word);      	
  }//CheckForStopWord
  
  /** подготовка текста для обработки */
  protected function PrepereSourceToGenerate(ss_ConnectQuery &$Request, $params) {
   $this->source = ($params && isset($params['source'])) ? $params['source'] : $this->GetConnect()->GetData();
   $this->source = $this->GetConnect()->GetSimplyTextFromPage(
    $this->source, (!$params || !isset($params['getfrombody']) || $params['getfrombody'])
   );
   //разделитель ключевых слов
   $this->separator = ($params && isset($params['separator'])) ? $params['separator'] : ', '; 
   //количество ключевых слов
   $this->usecount = ($params && isset($params['usecount']) && $params['usecount']) ? $params['usecount'] : 18;
   //минимальнаядлина слова
   $this->minlenght = ($params && isset($params['minlenght']) && $params['minlenght']) ? $params['minlenght'] : 3;
   //всего анализировать
   $this->allcount = ($params && isset($params['allcount']) && $params['allcount']) ? $params['allcount'] : 1000;
   return $this->source;	
  }//PrepereSourceToGenerate 	
  
  /** количество слов в тексте */
  protected function GetWordsCountInText($str, $separator=" ") {
   while (@$this->strpos($str, "  ") !== false) { $str = @str_replace("  ", " ", $str); }
   $str = @trim($str);
   if (!$str) { return 0; }
   if ($this->substr($str, 0, 1) == $separator) { $str = $this->substr($str, 1); }
   if ($this->substr($str, -1) == $separator) { $str = $this->substr($str, 0, -1); }
   $count = $this->substr_count($str, $separator);
   return (!$count) ? 1 : ($count + 1);   	
  }//GetWordsCountInText
  
  /** обработка слов текста */
  protected function ActionStepToWords($str, $func, $separator=" ") {
   $str1 = $str;
   $wordscount = $this->GetWordsCountInText($str, $separator);
   $this->res['wordscount'] = $wordscount;   
   $word = $this->StrFetch($str1, $separator);
   $index = 0;
   while ($word || $str1) {   	
	if (($word = @trim($word)) && !$this->CheckForStopWord($word)) { 	
	 if ($this->$func($word, $str, $wordscount, $separator)) {
	  $index++;
	  if ($this->allcount > 0 && $index >= $this->allcount) { break; }	
	 }		
	}	
	$word = $this->StrFetch($str1, $separator);
   }
   //компиляция списка слов   
   if ($this->res['wordslist']) {
	@usort($this->res['wordslist'], array('ss_Plugin_ActionKeywordsGenerator', 'CheckElements'));
	foreach ($this->res['wordslist'] as $item) {
	 if (!$this->res['result']) { $this->res['result'] = $item['word']; } else {
	  $this->res['result'] .=  $this->separator.$item['word'];	
	 }		
	}	
   }   
   return $str;  	
  }//ActionStepToWords
  
  /** количество вхождений */
  protected function GetIncludeCount($str, $word, $limit=0) {
   $word = @trim($word);
   if (!$str || !$word) { return 0; }
   $str = " $str "; $word = " $word ";
   $result = 0;
   $i = $this->stripos($str, $word);   
   while ($i !== false) {
   	$result++;
   	$i+=($this->strlen($word) - 1);   	
	$i = $this->stripos($str, $word, $i);
	if ($limit > 0 && $result >= $limit) { return $result; } 
   }
   return $result;
  }//GetIncludeCount
  
  /** сортировка массива */
  function CheckElements($a, $b) {	
   return ($a['inputs'] == $b['inputs']) ? 0 : (($a['inputs'] < $b['inputs']) ? 1 : -1);		
  }//CheckElements
  
  /** добавление нового слова */
  protected function AddNewWord($word, $inputscount, $wordscount) {
   $count = @count($this->res['wordslist']);
   if (!$count) { $count = 0; }
   //новое слово
   if ($count < $this->usecount) {
	$this->res['wordslist'][] = array(
	 'word'   => $word,
	 'inputs' => $inputscount,
	 'freg'   => ($wordscount <= 0) ? 0 : @round($inputscount / $wordscount, 3) //TF
	);
	return $this->array_modified = true;	
   }
   //сортировка массива
   if ($this->array_modified) {
    @usort($this->res['wordslist'], array('ss_Plugin_ActionKeywordsGenerator', 'CheckElements'));
    $this->array_modified = false;   
   }
   //проверка замен
   $index = 0;
   foreach ($this->res['wordslist'] as &$item) {
   	$index++;
	if ($item['inputs'] < $inputscount) {
	 $item['word']   = $word;
	 $item['inputs'] = $inputscount;
	 $item['freg']	 = ($wordscount <= 0) ? 0 : @round($inputscount / $wordscount, 3); //TF	 
	 $this->array_modified = ($index > 1);	 
	 return true;
	}
   }   
   return true;	
  }//AddNewWord
  
  /** обработка слов */
  protected function _ActionContentWords($word, $str, $wordscount, $separator) {
   if ($this->GetIncludeCount($this->tempsource, $word, 1)) { return false; }   
   $this->res['wordsnorepeat']++;
   if (!$this->tempsource) { $this->tempsource = $word; } else { $this->tempsource .= " ".$word; }
   return ($this->strlen($word) < $this->minlenght) ? false : 
   $this->AddNewWord($word, $this->GetIncludeCount($str, $word), $wordscount);
  }//_ActionContentWords	  	 	
  	 	
  function ExecPlugin(ss_ConnectQuery &$Request) {  
   $this->res = array(
    //результат обработки
    'result'     => '',
    //всего слов
    'wordscount' => 0,
    //всего слов без повторов
    'wordsnorepeat' => 0,
    //список слов
    'wordslist'  => array()
   );
   $this->array_modified = false;
   $this->tempsource = '';
   $this->ActionStepToWords($this->PrepereSourceToGenerate($Request, $this->GetRunParams()), '_ActionContentWords');
   return $this->res;
  }//ExecPlugin
  
  function GetFlagUseLongData() { return true; }
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5  
  	
 }//ss_Plugin_ActionKeywordsGenerator
 //-----------------------------------------------------------------
 /** анализ текста */
 final class ss_Plugin_ActionTextanalisis extends ss_Plugin_GenTemplate {		  
  private $res = false;
  private $stopwords = null;
  private $source = '';
  private $original_source = '';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'ActionTextanalisis', 'Анализ текста', -1);	 
  }//__construct
  
  /** проверка на стоп-слово */
  protected function CheckForStopWord($word) {
   $params = $this->GetRunParams();
   if (!$params || !isset($params['ignorestopwords']) || !$params['ignorestopwords']) { return false; }
   if (!$this->stopwords) { $this->stopwords = new ss_StopWords_obj(); }
   return $this->stopwords->CheckWord($word);      	
  }//CheckForStopWord
  
  /** подготовка текста для обработки */
  protected function PrepereSourceToGenerate(ss_ConnectQuery &$Request, $params) {
   $this->original_source = $params['source'];
   $this->source = $this->ClearElementsInText($this->original_source);
   //всего символов
   $this->res['allcharscount'] = $this->strlen($this->original_source);
   //всего символов без пробелов
   $this->res['allcharscount_nospaces'] = $this->strlen(@str_replace(' ', '', $this->original_source));
   //обработанный текст без тэгов и прочего
   $this->res['correctedsource'] = $this->source;
   //символов в обработанном тексте
   $this->res['resultlenght'] = $this->strlen($this->source);
   //количество символов без пробелов и переносов строк
   $this->res['allcharsnospacesandbreaks'] = $this->strlen(@str_replace(' ', '', 
    $this->clearBreake($this->original_source)
   ));   
   return $this->source;	
  }//PrepereSourceToGenerate 	
  
  /** количество слов в тексте */
  protected function GetWordsCountInText($str, $separator=" ") {
   while (@$this->strpos($str, "  ") !== false) { $str = @str_replace("  ", " ", $str); }
   $str = @trim($str);
   if (!$str) { return 0; }
   if ($this->substr($str, 0, 1) == $separator) { $str = $this->substr($str, 1); }
   if ($this->substr($str, -1) == $separator) { $str = $this->substr($str, 0, -1); }
   $count = $this->substr_count($str, $separator);
   return (!$count) ? 1 : ($count + 1);   	
  }//GetWordsCountInText
  
  /** обработка слов текста */
  protected function ActionStepToWords($str, $func, $separator=" ") {
   $str1 = $str;
   $this->res['wordscount'] = $this->GetWordsCountInText($str, $separator);  
   $word = $this->StrFetch($str1, $separator);
   while ($word || $str1) {   	
	if (($word = @trim($word))) {
	 if ($this->CheckForStopWord($word)) { 
	  $this->res['stopwordscount']++;
	  $this->res['stopwordslist'][] = $word; 
	 } else { $this->$func($word, $str, $this->res['wordscount'], $separator); }		
	}	
	$word = $this->StrFetch($str1, $separator);
   }  
   return $str;  	
  }//ActionStepToWords
  
  /** количество вхождений */
  protected function GetIncludeCount($str, $word, $limit=0) {
   $word = @trim($word);
   if (!$str || !$word) { return 0; }
   $str = " $str "; $word = " $word ";
   $result = 0;
   $i = $this->stripos($str, $word);   
   while ($i !== false) {
   	$result++;
   	$i+=($this->strlen($word) - 1);   	
	$i = $this->stripos($str, $word, $i);
	if ($limit > 0 && $result >= $limit) { return $result; } 
   }
   return $result;
  }//GetIncludeCount
  
  /** обработка слов */
  protected function _ActionContentWords($word, $str, $wordscount, $separator) {
   //слова
   if (!$this->res['textnostopwords']) { $this->res['textnostopwords'] = $word; } else { 
   	$this->res['textnostopwords'] .= " $word"; 
   }  	
   //вхождений слов
   if ($this->GetIncludeCount($this->res['textnorepeatandstopwords'], $word, 1)) { return false; }   
   $this->res['wordsnorepeat']++;
   //текст без повторов
   if (!$this->res['textnorepeatandstopwords']) { $this->res['textnorepeatandstopwords'] = $word; } else { 
   	$this->res['textnorepeatandstopwords'] .= " $word"; 
   }
   return true;
  }//_ActionContentWords	  	 	
  	 	
  function ExecPlugin(ss_ConnectQuery &$Request) {  
   $this->res = array(
    //всего слов
    'wordscount' => 0,
    //всего слов без повторов
    'wordsnorepeat' => 0,
    //кол-во стоп-слов
    'stopwordscount' => 0,
    //список стоп-слов
    'stopwordslist' => array(),
    //всего символов
    'allcharscount' => 0,
    //всего символов без пробелов
    'allcharscount_nospaces' => 0,
    //всего символов без пробелов и переносов строк
    'allcharsnospacesandbreaks' => 0,    
    //текст без тэгов и лишних символов
    'correctedsource' => '',
    //текст без стоп-слов
    'textnostopwords' => '',
    //текст без повторов и стоп-слов
    'textnorepeatandstopwords' => '',
    //символов в обработанном тексте
    'resultlenght' => 0 
    
   );
   $this->original_source = '';
   $this->source = '';
   $this->ActionStepToWords($this->PrepereSourceToGenerate($Request, $this->GetRunParams()), '_ActionContentWords');
   return $this->res;
  }//ExecPlugin 
  	
 }//ss_Plugin_ActionKeywordsGenerator
 //-----------------------------------------------------------------
 /** в топе по ключевым словам */
 final class ss_Plugin_URLinTOPbyKeywords extends ss_Plugin_GenTemplate {
  /* ссылка на запрос к api megaindex.ru */	
  const MEGAINDEX_LINK_QUERY = 'http://www.megaindex.ru/xml.php';
  /* кол-во ключевых слов */
  const MAXKEYWORDS_COUNT = 60; //max 1000			  
  private $res = false;
  private $Pparams = false;
  private $mb_check_encoding_exists = false;
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'URLinTOPbyKeywords', 'В топе по ключевым словам', 5);
   $this->mb_check_encoding_exists = @function_exists('mb_check_encoding');	 
  }//__construct 	
  	
  /** обработка параметров */
  protected function PreloadParams(&$params) {	
   $this->Pparams = array(
    'url'      => ($params && $params['url']) ? $params['url'] : $this->GetConnect()->url_real_host,
	'date'     => ($params && $params['date']) ? $params['date'] : @date('Y-m-d'),
    'login'    => ($params && $params['login']) ? $params['login'] : '',
    'password' => ($params && $params['password']) ? $params['password'] : ''  
   );
   return array();   	
  }//PreloadParams
  
  /** заголовок запроса */
  protected function GetPostHeader() {
   return 'text='.@rawurlencode('<?xml version="1.0" encoding="windows-1251"?>
   <request>
   <query report="siteAnalyze" site="'.$this->Pparams['url'].'" date="'.$this->Pparams['date'].'" />
   </request>');	
  }//GetPostHeader
  
  /** авторизация */
  protected function GetAutPostHeader() {
   return 'text='.@rawurlencode('<?xml version="1.0" encoding="windows-1251"?>
   <request>
   <query login="'.$this->Pparams['login'].'" pswd="'.$this->Pparams['password'].'" />
   </request>');	
  }//GetAutPostHeader
  	  	   	
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $params2 = $this->GetRunParams();  
   $this->res = $this->PreloadParams($params);
   if (!$this->Pparams['url']) { return $this->SetError('Error in get url for check..'); }
   //get params
   $Request->connect_use_cookies = false;
   $Request->connect_use_cookies_as_string = true;   
   //requst to auth
   if (!$Request->RequestPOST(self::MEGAINDEX_LINK_QUERY, $this->GetAutPostHeader())) { 
   	return $this->SetError($Request->res_error); 
   }      
   if (!$this->strstr($Request->GetData(), '<login>OK</login>')) { 
   	return $this->SetError('Uncorrect Login or Password');
   }
   $Request->connect_use_cookies = $Request->GetCOOKIESfromHeader();   
   //check encoded
   //$encoding = (@preg_match(
    //'/encoding[\s]*=[\s]*"(.*?)"/isU', $Request->GetData(), $mn
   //)) ? $this->strtoupper(trim($mn[1])) : 'UTF-8';
   //if ($encoding != SEOSCRIPTDEFENCODE) { $Request->connect_do_encoded_page = $encoding; }
   $Request->connect_do_encoded_page = 'UTF-8';      
   //requst to get data   
   if (!$Request->RequestPOST(self::MEGAINDEX_LINK_QUERY, $this->GetPostHeader())) { 
   	return $this->SetError($Request->res_error); 
   }       
   //ok, parse answer   
   $p = new ss_HTMLTagParser();
   $Request->SetParserTag('error', $p);
   if ($p) { if ($error = $p->GetParamValue('')) { return $this->SetError('Error: '.$error); } }
   //параметры, обработанные
   $Request->SetParserTag('query', $p);
   if ($p->GetSympleTag()) {
    $this->res['resultfor'] = array(
     'report' => $p->GetParamValue('report'),
     'site'   => $p->GetParamValue('site'),
     'date'   => $p->GetParamValue('date'),
    );
   }
   //result
   $Request->SetParserTag('item', $p);
   $this->res['result'] = array();
   $incer = 1;
   
   while ($p->GetSympleTag()) {
	if (self::MAXKEYWORDS_COUNT > 0) {
   	 if ($incer > self::MAXKEYWORDS_COUNT) { break; }
   	 $incer++;
   	}
   	$word = $p->GetParamValue('word'); 	
	$ok = ($this->mb_check_encoding_exists) ? !@mb_check_encoding($word, SEOSCRIPTDEFENCODE) : 
	@preg_replace('#[\x00-\x7F]|\xD0[\x81\x90-\xBF]|\xD1[\x91\x80-\x8F]#s', '', $word, 1);
	if ($ok) {   		
	 if ($word2 = @iconv('WINDOWS-1251', SEOSCRIPTDEFENCODE, $word)) { $word = $word2; }	 	
	}   	
   	if ($word) {
   	 $this->res['result'][] = array(
   	  //запрос
	  'word' => $word,
	  //позиция сайта по запросу в Yandex
	  'pos_y' => $p->GetParamValue('pos_y'),
      //позиция сайта по запросу в Google
	  'pos_g' => $p->GetParamValue('pos_g'),
	  //видимость сайта (в %) по данному запросу в различных поисковых системах
	  'vis' => $p->GetParamValue('vis'),
	  //показов за месяц
	  'show_month' => $p->GetParamValue('show_month'),
	  //показов в месяц по яндексу wordstat.yandex.ru
	  'wordstat' => ($params2['wordstat']) ? $p->GetParamValue('wordstat') : false,
	  //кол-во запросов в Yandex за месяц по данным direct.yandex.ru
	  'wordstat2' => ($params2['wordstat2']) ? $p->GetParamValue('wordstat2') : false,
	  //число переходов на страницы по данным liveinternet.ru
	  'jump_li' => ($params2['jump_li']) ? $p->GetParamValue('jump_li') : false,
	  //Стоимость - Оценочная стоимость продвижения сайта в первую 10-ку результатов поиска
	  'price' => ($params2['price']) ? $p->GetParamValue('price') : false   
	 );
	} 	
   }      
   return $this->res;  
  }//ExecPlugin
  
  function GetFlagUseLongData() { return true; }
  function GetCachURLmd5() { return @md5($this->strtolower($this->GetConnect()->url_real_host)); }    	
 }//ss_Plugin_URLinTOPbyKeywords
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */ 
?>