<?php

class HTMLHelpers
{
 /**
* Returns body classes made up by URI segments
*
* @return string
*/
 public static function bodyClass()
 {
	$body_classes = [];
	$class = "";
	 
	 foreach ( Request::segments() as $segment )
	 {
	 if ( is_numeric( $segment ) || empty( $segment ) ) {
	 continue;
	 }
	 
	$class .= ! empty( $class ) ? "-" . $segment : $segment;
	 
	array_push( $body_classes, 'page-'.$class );
	 }
	 
	 return ! empty( $body_classes ) ? implode( ' ', $body_classes ) : 'home';
	 }

  public static function timeAgo($time, $full = false)
  {
  	if($time->diffInHours() < 1){
  		return $time->diffInMinutes() . ($full ? ' minutes' : 'm');
  	} else if($time->diffInDays() < 1){
		return $time->diffInHours() . ($full ? ' hours' : 'h');
  	} else {
  		return $time->diffInDays() . ($full ? ' days' : 'd');
  	}
  }

}
