<?php
/** @var \Laravel\Lumen\Routing\Router $router */

// Default Lumen welcome route
$router->get('/', function () use ($router) {
    return $router->app->version();
});

// ✅ Correct Lumen-style routing
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users', 'UserController@getUsers'); // Get all users
    $router->post('/users', 'UserController@add'); // Create user
    $router->get('/users/{id}', 'UserController@show'); // Get user by ID
    $router->put('/users/{id}', 'UserController@update'); // Update user
    $router->delete('/users/{id}', 'UserController@delete'); // Delete user
});

// ✅ Lumen does NOT support `redirect()` directly
$router->get('/home', function () {
    return response()->json(['message' => 'Redirecting to /dashboard'], 302)
                     ->header('Location', '/dashboard'); 
});

$router->get('/dashboard', function () {
    return response()->json(['message' => 'Welcome to the dashboard!']);
});
