<?php
/** @var \Laravel\Lumen\Routing\Router $router */

<<<<<<< HEAD
=======
// Default Lumen welcome route
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
$router->get('/', function () use ($router) {
    return $router->app->version();
});

<<<<<<< HEAD
=======
// ✅ Correct Lumen-style routing
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users', 'UserController@getUsers'); // Get all users
    $router->post('/users', 'UserController@add'); // Create user
    $router->get('/users/{id}', 'UserController@show'); // Get user by ID
    $router->put('/users/{id}', 'UserController@update'); // Update user
    $router->delete('/users/{id}', 'UserController@delete'); // Delete user
});
<<<<<<< HEAD
=======

// ✅ Lumen does NOT support `redirect()` directly
$router->get('/home', function () {
    return response()->json(['message' => 'Redirecting to /dashboard'], 302)
                     ->header('Location', '/dashboard'); 
});

$router->get('/dashboard', function () {
    return response()->json(['message' => 'Welcome to the dashboard!']);
});
>>>>>>> 7a08be47408650d080d9694e0db59fc0ecb4f55c
