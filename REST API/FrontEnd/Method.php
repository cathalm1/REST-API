<?php

//action.php

if(isset($_POST["action"]))
{
    //insert data

    if($_POST["action"] == 'insert') {
        $form_data = array(
            'u_date' => $_POST['u_date'],
            'u_name' => $_POST['u_name'],
            'u_url' => $_POST['u_url'],
            'u_description' => $_POST['u_description']
        );

        //$r = var_dump($form_data);

        //echo "<script type='text/javascript'>alert('$r');</script>";

        $api_url = "http://localhost/2019Semester2/CathalMcGannon_17394416/API/RESTapiRequest.php?action=insert";
        $client = curl_init();

        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_URL, $api_url);

        $response = curl_exec($client);
        //echo "<script type='text/javascript'>alert('$response');</script>";

        if($response === false){
            $rr = 'error = '.curl_error($client);
            echo "<script type='text/javascript'>alert('$rr');</script>";
        }

        curl_close($client);

        $result = json_decode($response, true);
        $out = '';
        foreach ($result as $key => $val) {
            $q = $val['success'];
            if ($q === '1') {
                $out .= 'insert';
            } else {
                $out .= 'error';
            }
       }
        echo $out;
    }

    //get one piece of data to display for update

    if($_POST["action"] == 'fetch_single') {
        $id = $_POST["id"];
        $api_url = "http://localhost/2019Semester2/CathalMcGannon_17394416/API/RESTapiRequest.php?action=fetch_single&id=".$id."";
        $client = curl_init();
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_URL, $api_url);
        $response = curl_exec($client);
        echo $response;
    }


    //preform update request

    if($_POST["action"] == 'update') {

        $form_data = array(
            'u_date' => $_POST['u_date'],
            'u_name' => $_POST['u_name'],
            'u_url' => $_POST['u_url'],
            'u_description' => $_POST['u_description'],
            'u_id' => $_POST['hidden_id']
        );

        $api_url = "http://localhost/2019Semester2/CathalMcGannon_17394416/API/RESTapiRequest.php?action=update";
        $client = curl_init();
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_URL, $api_url);
        $response = curl_exec($client);

        //echo "<script type='text/javascript'>alert('$response');</script>";

        if($response === false){
            $rr = 'error = '.curl_error($client);
            echo "<script type='text/javascript'>alert('$rr');</script>";
        }

        curl_close($client);

        /*
        $a = var_dump($response);
        echo "<script type='text/javascript'>alert('$a');</script>";
        */

        $result = json_decode($response, true);
        $o = '';
        foreach ($result as $key => $val) {
            $w = $val['success'];
            if ($w === '1') {
                $o .= 'update';
            } else {
                $o .= 'error';
            }
        }
        echo $o;

    }


   //delete data request

    if($_POST["action"] == 'delete')
    {
        $id = $_POST['id'];
        $api_url = "http://localhost/2019Semester2/CathalMcGannon_17394416/API/RESTapiRequest.php?action=delete&id=".$id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        echo $response;
    }
}
