<?php


include('RESTapi.php');

$api_object = new API();

//------------------------------------------------

//get data

if($_GET["action"] == 'fetch_all') {
    $data = $api_object->fetch_all();
}

//------------------------------------------------

//insert

if($_GET["action"] == 'insert') {
    $data = $api_object->insert();
}

//------------------------------------------------

//get the data to be updated

if($_GET["action"] == 'fetch_single') {
    $id = $_GET["id"];
    $data = $api_object->fetch_single($id);
}

//------------------------------------------------

//update

if($_GET["action"] == 'update') {
    $data = $api_object->update();
}

//------------------------------------------------

//delete

if($_GET["action"] == 'delete') {
    $data = $api_object->delete($_GET["id"]);
}

//------------------------------------------------

echo json_encode($data);


