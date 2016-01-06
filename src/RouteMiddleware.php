<?php
	// Route Middleware is for functions required for checking if the user is logged in or not.

	function userLoggedIn() {
		$app = \Slim\Slim::getInstance();

		$login_config = (is_null($app->config('tjc.middleware.login')) ? 'login' : $app->config('tjc.middleware.login'));

		$app->config($login_config, TRUE);
	}