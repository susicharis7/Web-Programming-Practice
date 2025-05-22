<?php

Flight::route('GET /restaurant/@id', function($id){
    Flight::json(Flight::restaurantService()->get_restaurant_by_id($id));
});

Flight::route('GET /restaurant', function(){
    $location = Flight::request()->query['location'] ?? null;
    Flight::json(Flight::restaurantService()->get_restaurants($location));
});

Flight::route('POST /restaurant', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::restaurantService()->add_restaurant($data));
});

Flight::route('PUT /restaurant/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::restaurantService()->update_restaurant($id, $data));
});

Flight::route('DELETE /restaurant/@id', function($id){
    Flight::json(Flight::restaurantService()->delete_restaurant($id));
});
