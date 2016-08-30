<?php
// Routes

/**
 * Index 
 * - Index
 */
$app->get('/', 'App\Controller\IndexController:indexAction')->setName('index');

/**
 * Photo 
 * - Index
 */
$app->group('/photos', function () {
  $this->get('', 'App\Controller\PhotoController:indexAction')->setName('photo_index');
});

/**
 * Admin
 * - Index
 * - Photos
 *   - List
 */
$app->group('/admin', function () {
  $this->get('', 'App\Controller\Admin\IndexController:indexAction')->setName('admin_index');

  $this->group('/photos', function () {
    $this->get('', 'App\Controller\Admin\PhotoController:listAction')->setName('admin_photo_list');
    $this->get('/create', 'App\Controller\Admin\PhotoController:createAction')->setName('admin_photo_create');
    $this->get('/edit/{id}', 'App\Controller\Admin\PhotoController:editAction')->setName('admin_photo_edit');
    $this->post('/save', 'App\Controller\Admin\PhotoController:saveAction')->setName('admin_photo_save');
    $this->get('/delete/{id}', 'App\Controller\Admin\PhotoController:deleteAction')->setName('admin_photo_delete');
  });
});

/*
 * Login
 * - Index
 * - Login
 * - Logout
 */
$app->group('/login', function () {
  $this->get('', 'App\Controller\Admin\LoginController:indexAction')->setName('login_index');
  $this->get('/check', 'App\Controller\Admin\LoginController:loginAction')->setName('login_check');
  $this->get('/out', 'App\Controller\Admin\LoginController:logoutAction')->setName('login_logout');
});