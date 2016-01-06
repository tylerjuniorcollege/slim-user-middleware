<?php
	// Route Middleware is for functions required for checking if the user is logged in or not.

	function userLoggedIn() {
		$app = \Slim\Slim::getInstance();

		/* $login_config = (is_null($app->config('tjc.middleware.login')) ? 'login' : $app->config('tjc.middleware.login'));

		$app->config($login_config, TRUE); */

		$login_redirect = (is_null($this->app->config('tjc.middleware.login.redirect')) ? '/' : $this->app->config('tjc.middleware.login.redirect'));

		$logged_out_message = (is_null($this->app->config('tjc.middleware.login.message')) ? 'You Must Be Logged In to Access That.' : $this->app->config('tjc.middleware.login.message'));

		$user_singleton = (is_null($this->app->config('tjc.middleware.user')) ? 'user' : $this->app->config('tjc.middleware.user'));

		if($app->$user_singleton === FALSE) { // We should flash a message and halt the application.
			$app->flash('error', $logged_out_message);
			$app->redirect($login_redirect);
		}
	}