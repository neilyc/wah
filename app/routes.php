<?php
// Routes

/* FRONT */
$app->group('/', function () {
  /**
   * Index 
   * - Index
   */
  $this->get('', 'App\Controller\IndexController:indexAction')->setName('index');

  $this->group('photos', function () {
    $this->get('', 'App\Controller\PhotoController:indexAction')->setName('photo_index');
  });

  $this->group('services', function () {
    $this->get('', 'App\Controller\ServiceController:indexAction')->setName('service_index');
  });

  $this->group('hebergements', function () {
    $this->get('', 'App\Controller\LodgingController:indexAction')->setName('lodging_index');
  });

  $this->group('infos', function () {
    $this->get('', 'App\Controller\InfosController:indexAction')->setName('infos_index');
    $this->post('/contact', 'App\Controller\InfosController:contactAction')->setName('infos_contact');
  });

  $this->group('about', function () {
    $this->get('', 'App\Controller\AboutController:indexAction')->setName('about_index');
  });
});
/**
 * Photo 
 * - Index
 */


/* ADMIN */
$app->group('/admin', function () {
  $this->get('', 'App\Controller\Admin\IndexController:indexAction')->setName('admin_index');

  $this->group('/photos', function () {
    $this->get('', 'App\Controller\Admin\PhotoController:listAction')->setName('admin_photo_list');
    $this->get('/create', 'App\Controller\Admin\PhotoController:createAction')->setName('admin_photo_create');
    $this->get('/edit/{id}', 'App\Controller\Admin\PhotoController:editAction')->setName('admin_photo_edit');
    $this->post('/save', 'App\Controller\Admin\PhotoController:saveAction')->setName('admin_photo_save');
    $this->get('/delete/{id}', 'App\Controller\Admin\PhotoController:deleteAction')->setName('admin_photo_delete');
  });

  $this->group('/services', function () {
    $this->get('', 'App\Controller\Admin\ServiceController:listAction')->setName('admin_service_list');
    $this->get('/create', 'App\Controller\Admin\ServiceController:createAction')->setName('admin_service_create');
    $this->get('/edit/{id}', 'App\Controller\Admin\ServiceController:editAction')->setName('admin_service_edit');
    $this->post('/save', 'App\Controller\Admin\ServiceController:saveAction')->setName('admin_service_save');
    $this->get('/delete/{id}', 'App\Controller\Admin\ServiceController:deleteAction')->setName('admin_service_delete');
  });

  $this->group('/hebergements', function () {
    $this->get('', 'App\Controller\Admin\LodgingController:listAction')->setName('admin_lodging_list');
    $this->get('/create', 'App\Controller\Admin\LodgingController:createAction')->setName('admin_lodging_create');
    $this->get('/edit/{id}', 'App\Controller\Admin\LodgingController:editAction')->setName('admin_lodging_edit');
    $this->post('/save', 'App\Controller\Admin\LodgingController:saveAction')->setName('admin_lodging_save');
    $this->get('/delete/{id}', 'App\Controller\Admin\LodgingController:deleteAction')->setName('admin_lodging_delete');
  });

  $this->group('/lodginginfos', function () {
    $this->post('/save', 'App\Controller\Admin\LodgingInfosController:saveAction')->setName('admin_lodginginfos_save');
  }); 

  $this->group('/infos', function () {
    $this->get('', 'App\Controller\Admin\InfosController:editAction')->setName('admin_infos_edit');
    $this->post('/save', 'App\Controller\Admin\InfosController:saveAction')->setName('admin_infos_save');
  }); 

  $this->group('/about', function () {
    $this->get('', 'App\Controller\Admin\AboutController:editAction')->setName('admin_about_edit');
    $this->post('/save', 'App\Controller\Admin\AboutController:saveAction')->setName('admin_about_save');
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