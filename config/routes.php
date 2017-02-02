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
  $routes->post('/track', function(){
  TrackController::store();
  });
      $routes->get('/login', function() {
    HelloWorldController::login();
  });
