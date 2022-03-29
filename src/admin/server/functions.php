<?php

	function checkAuth(){
		global $_COOKIE;
		if(
			!isset($_COOKIE['AUCTION-ADMIN-ID']) || 
			empty($_COOKIE['AUCTION-ADMIN-ID']) || 
			strlen($_COOKIE['AUCTION-ADMIN-ID']) != 32
		) return false;

		$session = R::findOne('admins__sessions', 'session_id = ?', [$_COOKIE['AUCTION-ADMIN-ID']]);
		if(!$session) return false;

		$admin = R::findOne('admins', 'id = ?', [$session->admin_id]);
		return $admin;
	}

?>