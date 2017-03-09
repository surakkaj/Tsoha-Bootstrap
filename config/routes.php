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
        HoleController::add($id);
  });
    $routes->post('/track/:id/add', function($id) {
        TrackController::holes($id);
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
  $routes->post('/track/:id/run', function($id){
  TrackController::run($id);
  });
  $routes->get('/track/:id/:run', function($id,$run){
  TrackController::view_run($id,$run);
  });
  $routes->post('/track/:id/scores', function($id){
  TrackController::store_run($id);
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
      $routes->post('/logout', function() {
          PlayerController::logout();
  });
      $routes->get('/login/new', function() {
          PlayerController::add();
  });
      $routes->post('/login/new', function() {
          PlayerController::store();
  });
      $routes->get('/admin', function() {
          PlayerController::admin();
  });

  
  