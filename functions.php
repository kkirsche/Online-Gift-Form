<?php
	// ====================================================================================================// 
	// ! Returns Todays date to be echoed out to the browser. Formatted as Monday, August 27, 2012         //        
	// ====================================================================================================//
	function getTodaysDate() {
		$today = date("l, F j, Y");
		return $today;
	}

?>