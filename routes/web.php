<?php

/*Route::get('/', function () {
    return redirect('admin');
});*/

Route::get('/', function () {
    return redirect('/login');
});

//Route::get('/admin/{demopage?}', 'DemoController@demo')->name('demo');
Route::get('/login', '/Auth/LoginController@login')->name('login'); 
//Route::get('/logout', '/Auth/LoginController');
Route::get('/register', '/Auth/RegisterController@register')->name('register');



Auth::routes();

Route::prefix('admin')->group(function(){
    
    
    Route::get('/logout','Auth\LoginController@logout');
    //Route::get('/listeUsers', 'Auth\LoginController@index')->name('index');


    Route::get('/', 'DemoController@index')->name('index');
    Route::get('/department', 'DepartmentController@index')->name('index');
    Route::get('/department/create', 'DepartmentController@create')->name('create');
    Route::post('/department/store', 'DepartmentController@store')->name('store');
    Route::get('/department/show/{id}', 'DepartmentController@show')->name('show');

    /* Project Type */
    Route::get('/projectsTypes', 'ProjectTypeController@index')->name('index');
    Route::get('/projectsTypes/create', 'ProjectTypeController@create')->name('create');
    Route::post('/projectsTypes/store', 'ProjectTypeController@store')->name('store');
    Route::get('/projectsTypes/{id}/show', 'ProjectTypeController@show')->name('show');
    /* END Project Type */

    /* Team Routes */
    Route::get('teams', 'TeamController@index')->name('index');
    Route::get('newTeam', 'TeamController@create')->name('create');
    Route::post('team/store', 'TeamController@store')->name('store');
    Route::get('team/show/{id}', 'TeamController@show')->name('show');
    /* End Team Routes */

    /* Employe Routes */
    Route::get('employes', 'EmployeController@index')->name('index');
    Route::get('newEmploye', 'EmployeController@create')->name('create');
    Route::post('employe/store', 'EmployeController@store')->name('store');
    Route::get('employe/show/{id}', 'EmployeController@show')->name('show');
    /* End Employe Routes */

    /* Project Routes */
    Route::get('projects', 'ProjectController@index')->name('index');
    Route::get('ongoingProjects', 'ProjectController@ongoing')->name('ongoing');
    Route::get('overdueProjects', 'ProjectController@overdue')->name('overdue');
    Route::get('newProject', 'ProjectController@create')->name('create');
    Route::post('project/store', 'ProjectController@store')->name('store');
    Route::get('project/{id}/show', 'ProjectController@show')->name('show');
    Route::get('project/{id}/edit', 'ProjectController@edit')->name('edit');
    Route::get('autocompletion', 'ProjectController@autocomplete')->name('autocomplete');
   
    /* End EmProject Routes */

    /* Task Routes */

       /* Route::get('/tasks', 'TaskController@index')->name('index');
        Route::get('/createTask', 'TaskController@create')->name('create');
        Route::post('/tasks/store', 'TaskController@store')->name('store');
        Route::get('/tasks/{id}/show', 'TaskController@show')->name('show');
        Route::post('/task/add', 'TaskController@add')->name('createTask');
        Route::post('/task/update', 'TaskController@update')->name('createTask');
        */

       
    Route::get('/task/create', 'TaskController@create')->name('taskCreate');
    Route::get('/task/edit/{id}', 'TaskController@edit')->name('editTask');
    Route::post('/task/add', 'TaskController@add')->name('createTask');
    Route::post('/task/update', 'TaskController@update')->name('updateTask');
    Route::get('/task/delete/{id}', 'TaskController@delete')->name('deleteTask');
    Route::get('/task/show/{id}', 'TaskController@show')->name('showTask');

    Route::get('/createTask', 'TaskController@create')->name('create');
    Route::get('/indexTask', 'TaskController@index')->name('index');
    Route::get('/showTask', 'TaskController@show')->name('show');

    /* END tasks */



    /* Comments Routes */
 
    Route::get('/comment/create', 'CommentController@create')->name('CommentCreate');
    Route::get('/comment/edit/{id}', 'CommentController@edit')->name('editComment');
    Route::post('/comment/add', 'CommentController@add')->name('createComment');
    Route::post('/comment/update', 'CommentController@update')->name('updateComment');
    Route::get('/comment/delete/{id}', 'CommentController@delete')->name('deleteComment');
    Route::get('/comment/show/{id}', 'CommentController@show')->name('showComment');

    //Route::get('/createComment', 'CommentController@create')->name('create');
    Route::get('/commentList', 'CommentController@index')->name('index');
    Route::get('/showComment', 'CommentController@show')->name('show');

        /* END comments */


     //Controller des users
     
     Route::get('/user/show/{id}', 'UsersController@show')->name('showUser');

     Route::get('/listeUsers', 'UsersController@index')->name('index');  
     //Route::post('/user/add', 'CommentController@addTeam')->name('addTeam'); 
    
     Route::get('/user/edit/{id}', 'UsersController@edit')->name('editUser');
     Route::post('/user/update', 'UsersController@update')->name('updateUser');

    
     //End 


});

Route::get('/home', 'HomeController@index')->name('home');
