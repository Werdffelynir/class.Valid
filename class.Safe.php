<?php
// START CLASS
class Safe{
	public $help = "
<pre>
HELP class Safe/////////////////////////////////////////////////
v 0.0.1
автор: OL Werdffelynir.
последнее обновление: 12.02.2013
временный сайт: safe.zz.mu


................................................................

[obj]->sql() 	... для безопасных запросов к db, аналог mysql_real_escape_string(), но не требует предварительного конекта к базе.
					возврвщает переобразованую строку строку

[obj]->mail() 	... проверка на регулярное выражение, спец символы
					возврвщает строку или false

[obj]->pass() 	... проверка на валидность и спец символы, имеет два парамета, и четыри типов проверки () Registers are not dependent. 
						1(обяз.) - строка, что передаем 
							[obj]->pass(str, 'en', '123', 'rnd')
							[obj]->pass(str, 'ru', 'not123', 'notrnd')
					возврвщает строку

[obj]->user() 	... проверка на спец символы, имеет два парамета, и шесть типов проверки (en, ru, enru, enruSp, enSp, ruSp). 
						1(обяз.) - строка, что передаем 
							[obj]->user(str)

						2(необяз.) - en(по умолчаию) проверяет строку на символы - 'a-z знаки', '_', '-', '.').
							[obj]->user(str, 'en')

						2(необяз.) - ru проверяет строку на символы - 'а-я знаки', '_', '-', '.').
							[obj]->user(str, 'ru')

						2(необяз.) - enru проверяет строку на символы - 'a-z а-я знаки', '_', '-', '.').
							[obj]->user(str, 'enru')

						2(необяз.) - enruSp (латинский и руский с пробелом)проверяет строку на символы - 'a-z а-я знаки', ' ', '_', '-', '.').
							[obj]->user(str, 'enruSp')

						2(необяз.) - enSp (латинский с пробелом)проверяет строку на символы - 'a-z знаки', ' ', '_', '-', '.').
							[obj]->user(str, 'enSp')

						2(необяз.) - ruSp (руский с пробелом) проверяет строку на символы - 'а-я знаки', ' ', '_', '-', '.').
							[obj]->user(str, 'ruSp')

					возврвщает строку или false

[obj]->massege()... перекодированеи, имеет три парамета, 
						1(обяз.) - строка, что передаем 
							[obj]->massege(str)
						2(необяз.) - encode(по умолчаию) кодирует строку, decode - разкодирует строку.
							[obj]->massege(str, 'decode')
						3(необяз.) - nodelteg(по умолчаию) ничего не делает, delteg - удаляет все html теги.
							[obj]->massege(str, 'encode','delteg')
					возвращает переобразованую строку

[obj]->text() 	... аналог метода massege().
</pre>
";
	public $user;
	public $pass;
	public $mail;
	public $domin;
	public $massege;
	public $text;
	public $debug = false;
	public $error = "<hr /><h2 style='color:red'>Ошибка, не существующий параметр</h2><hr />";

	function user($str, $leng="en"){
		$str = trim($str);
		$regEn = "/^[a-zA-Z0-9_\-\.]{2,25}$/u";//$str, "en"
		$regRu = "/^[а-яА-Я0-9_\-\.]{2,25}$/u";//$str, "ru"
		$regRuEn = "/^[а-яА-Яa-zA-Z0-9_\-\.]{2,25}$/u";//$str, "enru"
		$regRuEnSp = "/^[\s?а-яА-Яa-zA-Z0-9_\-\.]{2,25}$/u";//$str, "enruSp"
		$regEnSp = "/^[\s?a-zA-Z0-9_\-\.]{2,25}$/u";//$str, "enSp"
		$regRuSp = "/^[\s?а-яА-Я0-9_\-\.]{2,25}$/u";//$str, "ruSp"

		if($leng == "en"){
			if ( preg_match($regEn, $str) ) {
			    return $str;
			}else{
				if($this->debug){
					echo "<hr /><h2 style='color:red'>ошибка имени user! должен быть en параметр! : "
					.$str."</h2><hr />";
				}
				return false;
			}
		}elseif ($leng == "ru") {
			if ( preg_match($regRu, $str) ) {
			    return $str;
			}else{
				if($this->debug){
					echo "<hr /><h2 style='color:red'>ошибка имени user! должен быть ru параметр! : "
					.$str."</h2><hr />";
				}
				return false;
			}
		}elseif ($leng == "enru") {
			if ( preg_match($regRuEn, $str) ) {
			    return $str;
			}else{
				if($this->debug){
					echo "<hr /><h2 style='color:red'>ошибка имени user! должен быть enru параметр! : "
					.$str."</h2><hr />";
				}
				return false;
			}
		}elseif ($leng == "enruSp") {
			if ( preg_match($regRuEnSp, $str) ) {
			    return $str;
			}else{
				if($this->debug){
					echo "<hr /><h2 style='color:red'>ошибка имени user! должен быть enruSp параметр! : "
					.$str."</h2><hr />";
				}
				return false;
			}
		}elseif ($leng == "enSp") {
			if ( preg_match($regEnSp, $str) ) {
			    return $str;
			}else{
				if($this->debug){
					echo "<hr /><h2 style='color:red'>ошибка имени user! должен быть enSp параметр! : "
					.$str."</h2><hr />";
				}
				return false;
			}
		}elseif ($leng == "ruSp") {
			if ( preg_match($regRuSp, $str) ) {
			    return $str;
			}else{
				if($this->debug){
					echo "<hr /><h2 style='color:red'>ошибка имени user! должен быть ruSp параметр! : "
					.$str."</h2><hr />";
				}
				return false;
			}
		}else{
			    echo $this->error;
			}
	}



	function pass($str){
		$str = trim($str);
		if ( preg_match("/^[a-z0-9_\-]{3,15}$/u i", $str) ) {
		    $this->pass = $str;
		    return $str;
		}else{
			if($this->debug){
				echo "<hr /><h2 style='color:red'>ошибка соотвецтвия пароля правилам! : ".$str."</h2><hr />";
			}
			return false;
		}
	}


	function domin($str){
		$str = trim($str);
		if ( preg_match("/^(http:\/\/)?(\w\w\w)?(\/)?\w+-*\w*\.\w+[\.]?\w*[\.]?\w*$/", $str) ) {
		    return $str;
		}else{
			if($this->debug){
				echo "<hr /><h2 style='color:red'>ошибка доменного имени! : ".$str."</h2><hr />";
			}
			return false;
		}
	}


	function sql($str, $code="encode"){
		$search =array("\\",   "\0",  "\n",  "\r",  "\x1a", "'",  '"',  "\x00",  "\x1a",  "\0x27",  "\0x5c",  "\0x27"  );
		$replace=array("\\\\", "\\0", "\\n", "\\r", "\Z",   "\'", '\"', "\\x00", "\\x1a", "\\0x27", "\\0x5c", "\\0x27" );
		return str_replace($search,$replace,$str);
	}

	function help(){
		echo $this->help;
	}

	function error(){
		echo $this->error;
	}

	function mail($str, $code="encode"){
		$str = trim($str);
		if ( preg_match("/^[\-_\.a-z0-9]{1,20}?@[\.\-a-z0-9]{0,6}?[\.a-z0-9]{1,10}$/i", $str) ) {
		    return $str;
		}else{
			if($this->debug){
				echo "<hr /><h2 style='color:red'>ошибка email адреса! : "
				.$str."</h2><hr />";
			}	
			return false;
		}
	}

	function massege($str, $code="encode", $deltegs="nodelteg"){
		if($code == "encode"){
			if($deltegs == "delteg"){
				$str = strip_tags($str);
			}
			$str = trim(addslashes(htmlspecialchars($str)));
			return $str;
		}elseif ($code == "decode") {
			$str = stripslashes(htmlspecialchars_decode($str));
			return $str;
		}else{
			echo $this->error;
		}
		
	}
	
	function text($str, $code="encode", $deltegs="nodelteg"){
		if($code == "encode"){
			if($deltegs == "delteg"){
				$str = strip_tags($str);
			}
			$str = trim(addslashes(htmlspecialchars($str)));
			return $str;
		}elseif ($code == "decode") {
			$str = stripslashes(htmlspecialchars_decode($str));
			return $str;
		}else{
			echo $this->error;
		}
		
	}

}// END CLASS


