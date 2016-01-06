<?php

	/**
	 * TJC\User\UserMiddleware is service to register and inject the user object in to the app.
	 **/

namespace TJC\User;

class LoginMiddleware extends \Slim\Middleware 
{
	public function call() {
		// Getting the singleton name:
		$user_singleton = (is_null($this->app->config('tjc.middleware.user')) ? 'user' : $this->app->config('tjc.middleware.user'));

		// Getting the config name for the login.
		$login_config = (is_null($this->app->config('tjc.middleware.login')) ? 'login' : $this->app->config('tjc.middleware.login'));

		$login_redirect = (is_null($this->app->config('tjc.middleware.login.redirect')) ? '/' : $this->app->config('tjc.middleware.login.redirect'));

		$logged_out_message = (is_null($this->app->config('tjc.middleware.login.message')) ? 'You Must Be Logged In to Access That.' : $this->app->config('tjc.middleware.login.message'));

		$app = $this->app;

		$this->app->hook('slim.before.dispatch', function() use($app, $user_singleton, $login_config, $login_redirect, $logged_out_message) {
			$route_login = $app->config($login_config);
			if(!is_null($route_login)) { // This should be set to true if the function was called.
				if($app->$user_singleton === FALSE) { // We should flash a message and halt the application.
					$app->flash('error', $logged_out_message);
					$app->redirect($login_redirect);
				}
			}
		}, 1);

		$this->next->call();
	}
}