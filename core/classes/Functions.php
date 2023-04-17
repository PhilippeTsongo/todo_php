<?php
class Functions
{
	public static function getRequestHeaders()
	{
		$headers = null;
		if (isset($_SERVER['Authorization'])) {
			$headers = trim($_SERVER["Authorization"]);
		} else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { 
			$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
		} elseif (function_exists('apache_request_headers')) {
			$requestHeaders = apache_request_headers();
			$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
			if (isset($requestHeaders['Authorization'])) {
				$headers = trim($requestHeaders['Authorization']);
			}
		}
		return $headers;
	}

	public static function getBasicAuthValue($headers)
	{
		return str_replace("Basic ", "", $headers);
	}

	public static function getBearerAuthValue($headers)
	{
		return str_replace("Bearer ", "", $headers);
	}

	
	// public static function HttRequest($url, $method = "POST", $data = array(), $requesttoken = '', $contenttype = "urlform")
	// {
	// 	$ch = curl_init();
	// 	switch ($contenttype) {
	// 		case "urlform":
	// 			$data = http_build_query($data);
	// 			$contenttype = 'application/x-www-form-urlencoded';
	// 			break;
	// 		case "json":
	// 			$data = json_encode($data);
	// 			$contenttype = 'application/json';
	// 			break;
	// 		case "xml":
	// 			$xml = new SimpleXMLElement('COMMAND');
	// 			array_walk_recursive($data, array($xml, 'command'));
	// 			print $xml->asXML();
	// 			$contenttype = 'application/xml';
	// 			break;

	// 		default:
	// 			break;
	// 	}

	// 	curl_setopt($ch, CURLOPT_URL, $url);
	// 	switch ($method) {
	// 		case "POST":
	// 			curl_setopt($ch, CURLOPT_POST, true);
	// 			if ($data)
	// 				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// 			break;
	// 		case "PUT":
	// 			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	// 			if ($data)
	// 				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// 			break;
	// 		default:
	// 	}
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $requesttoken, 'Content-Type:' . $contenttype));
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	$result = curl_exec($ch);
	// 	curl_close($ch);
	// 	return $result;

	// }

	public static function json_enc($str)
	{
		return json_encode($str, true);
	}

	public static function json_dec($str)
	{
		return json_decode($str, true);
	}


	

}
   ?>