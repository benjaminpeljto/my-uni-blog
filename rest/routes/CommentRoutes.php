<?php
Flight::route("GET /comments", function () {
    Flight::json(Flight::commentService()->get_all());
});

Flight::route("GET /comment/@id", function ($id) {
    Flight::json(Flight::commentService()->get_by_id($id));
});

Flight::route("GET /commentsById", function () {
    Flight::json(Flight::commentService()->get_by_id(Flight::request()->query['id']));
});

Flight::route("DELETE /comments/@id", function ($id) {
    Flight::commentService()->delete($id);
    Flight::json(['message' => 'blog by id ' . $id . ' has been deleted.']);
});

Flight::route("POST /comments", function () {
    $data = Flight::request()->data->getData();
    $response = Flight::commentService()->add($data);
    Flight::json(['message' => 'blog added sucessfully.', 'Data: ' => $response]);

});

Flight::route("PUT /comments/@id", function ($id) {
    $data = Flight::request()->data->getData();
    $response = Flight::commentService()->update($data, $id);
    Flight::json(['message' => 'Updated blog with new data.', 'Data' => $response]);
});
