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
  $routes->get('/moro', function() {
    HelloWorldController::moro();
  });
    $routes->get('/track', function() {
    HelloWorldController::track();
  });
      $routes->get('/tracks', function() {
    HelloWorldController::tracks();
  });
