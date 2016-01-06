# Simple User Middleware for Slim Framework

This package is a no-nonsense, simple User/Login Middleware for Slim Framework 2.x., without the requirements for any thing like user permissions or roles.

This package consists of Two Slim Middleware objects, and a Route Middleware function for pages that require being logged in.

# Setup
After including the package in to the "require" portion of the composer.json, you need to set the middleware using the `add()` function in the Slim Object.

```php
	$app->add(new TJC\User\UserMiddleware());
	$app->add(new TJC\User\LoginMiddleware());
```

The order in which you add them really doesn't matter. The User Middleware's action all occur before the main application is called, and the Login Middleware actions write a before dispatch hook.

## Dependency Injection Notes
Currently, `user` and `login` are being used by the package for keeping the user logged in and kicking the user out if they are not logged in. You can change these dependency variable names by setting the `tjc.middleware.user` and `tjc.middleware.login` in the App config during instanciation.