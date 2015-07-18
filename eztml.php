<?php

// extract input from stdin
$str = file_get_contents("php://stdin");

// parse config
$jsonstr = file_get_contents("config.json");
$jsondata = json_decode($jsonstr, true);
$pres = $jsondata["pres"];
$posts = $jsondata["posts"];

function wrap( $text, $options ) {
	global $pres, $posts;
	$retval = $text;
	$options = explode(",", $options);
	foreach( $options as $option ) {
		if( !array_key_exists($option, $pres) || !array_key_exists($option, $posts) ) {
			exit("option '$option' not configured! check your config.json\n");
		}
		$retval = $pres[$option] . $retval . $posts[$option];
	}
	return $retval;
}

function parsehtml( $text ) {
	global $str;
	$regex = "/({\(([a-z]*),?\)(.*)})/";
	$regex = "/{\(((([a-z0-9]*),?)*)\)((?:[^{}]+|(?R))*)}/";
	preg_match_all($regex, $text, $matches, PREG_SET_ORDER);
	$processing = true;
	while( $processing ) {
		if( preg_match_all($regex, $text, $matches, PREG_SET_ORDER) > 0 ) {
			$processing = true;
			foreach( $matches as $match ) {
				$match_ret = parsehtml($match[4]);
				$replacement = wrap($match[4], $match[1]);
				$text = str_replace($match[0], $replacement, $text);
			}
		} else {
			$processing = false;
		}
	}
	return $text;
}

print(parsehtml($str));

?>
