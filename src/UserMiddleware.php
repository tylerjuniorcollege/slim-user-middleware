<?php

	/**
	 * TJC\User\UserMiddleware is service to register and inject the user object in to the app.
	 **/

namespace TJC\User;

class UserMiddleware extends \Slim\Middleware 
{
	public function call() {
		// Getting the singleton name:
		$singleton_name = (is_null($app->config('tjc.middleware.user')) ? 'user' : $app->config('tjc.middleware.user'));

		// Creating user singleton.
		$this->app->container->singleton($singleton_name, function() use($singleton_name) {
			if(isset($_SESSION[$singleton_name]) && !is_null($_SESSION[$singleton_name])) { // by using the user singleton name in the session, we can safely assume that it won't be used by the developer.
				return $_SESSION[$singleton_name];
			} else {
				return FALSE;
			}
		});

		$this->next->call();
	}
}