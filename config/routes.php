<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  $routes->get('/testi/:id', function($id) {
    HelloWorldController::testi($id);
  });
/*
 * track
 */
    $routes->get('/track', function() {
        TrackController::index();
  });
    $routes->get('/track/add', function() {
        TrackController::add();
  });
    $routes->get('/track/:id', function($id) {
        TrackController::view($id);
  });
    $routes->get('/track/:id/add', function($id) {
        TrackController::view($id);
  });
    $routes->get('/track/:id/edit', function($id) {
        TrackController::edit($id);
  });
    $routes->post('/track/:id/edit', function($id) {
        TrackController::update($id);
  });
    $routes->post('/track/:id/destroy', function($id) {
        TrackController::destroy($id);
  });
  $routes->post('/track', function(){
  TrackController::store();
  });
  /*
   * Player
   */
      $routes->get('/login', function() {
          PlayerController::login();
  });
      $routes->post('/login', function() {
          PlayerController::logger();
  });

  
  