<?php 


function get_name($name) {
	try {
//echo urldecode(iconv(mb_detect_encoding($name, mb_detect_order(), true), "UTF-8", $name));

		$name = utf8_encode(urldecode($name));
		$name = clean_string($name);
		$lastname = DB::queryFirstRow("SELECT id, headword, IFNULL(description_spa, '') AS description_spa FROM lastnames WHERE headword = '$name'");

		if (count($lastname) == 0) {
			$lastname['id'] = 0;
			$lastname['headword'] = $name;
			$lastname['description_spa'] = not_found();
		} 
	
		print_r(json_encode($lastname, JSON_UNESCAPED_UNICODE));
	} catch (Exception $e) {
		$lastname['id'] = 0;
		$lastname['headword'] = $name;
		$lastname['description_spa'] = not_found();
		print_r(json_encode($lastname, JSON_UNESCAPED_UNICODE));
	}
}




