<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/


$router->get('/', 'Auth');
$router->get('/home', 'Home');
$router->group('/auth', function() use ($router){
    $router->match('/register', 'Auth::register', ['POST', 'GET']);
    $router->match('/login', 'Auth::login', ['POST', 'GET']);
    $router->get('/logout', 'Auth::logout');
    $router->match('/password-reset', 'Auth::password_reset', ['POST', 'GET']);
    $router->match('/set-new-password', 'Auth::set_new_password', ['POST', 'GET']);
});


$router->group('/user', function() use ($router) {
    $router->match('/jobseeker/profile', 'userController::jobSeekerProfile', ['POST', 'GET']);

    $router->match('/employer/profile', 'userController::employerProfile', ['POST', 'GET']);
    $router->match('/employer/job-post', 'jobController::jobPost', ['POST', 'GET']);
    $router->match('/employer/job-post-lists', 'jobController::getJob', ['POST', 'GET']);
    $router->match('/employer/jobPosts', 'jobController::jobPosts', ['POST', 'GET']);
    $router->match('/employer/updateJobPost/{id}', 'jobController::updateJobPost', ['POST', 'GET']);
    $router->match('/employer/deleteJob/{id}', 'jobController::deleteJob', ['POST', 'GET']);

    $router->match('/profile/edit-profile', 'userController::editProfile', ['POST', 'GET']);
    $router->match('/profile/editEmployerProfile', 'userController::editEmployerProfile', ['POST', 'GET']);

} );

$router->group('/admin', function() use ($router){
    $router->match('/dashboard', 'adminController::dashboard', ['POST', 'GET']);
    $router->match('/analytics', 'adminController::analytics', ['POST', 'GET']); 
    $router->match('/jobs', 'adminController::jobs', ['POST', 'GET']);
    $router->match('/jobs/add-jobs', 'adminController::addJobs', ['POST', 'GET']);
    $router->match('/jobseekers', 'adminController::jobSeekers', ['POST', 'GET']);
    $router->match('/applications', 'adminController::application', ['POST', 'GET']);
});
