<?php
Flight::route("GET /blogs", function () {
    Flight::json(Flight::blogService()->get_all());
});

Flight::route("GET /blog/@id", function ($id) {
    Flight::json(Flight::blogService()->get_by_id($id));
});

Flight::route("GET /blogsById", function () {
    Flight::json(Flight::blogService()->get_by_id(Flight::request()->query['id']));
});

Flight::route("DELETE /blogs/@id", function ($id) {
    Flight::blogService()->delete($id);
    Flight::json(['message' => 'blog by id ' . $id . ' has been deleted.']);
});

Flight::route("POST /blogs", function () {
    $data = Flight::request()->data->getData();
    $response = Flight::blogService()->add($data);
    Flight::json(['message' => 'blog added sucessfully.', 'Data: ' => $response]);

});

Flight::route("PUT /blogs/@id", function ($id) {
    $data = Flight::request()->data->getData();
    $response = Flight::blogService()->update($data, $id);
    Flight::json(['message' => 'Updated blog with new data.', 'Data' => $response]);
});
