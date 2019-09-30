<?php


$api_url = 'http://localhost/2019Semester2/CathalMcGannon_17394416/API/RESTapiRequest.php?action=fetch_all';

//add in

$client = curl_init();
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
curl_setopt($client, CURLOPT_URL, $api_url);
$response = curl_exec($client);

if($response === false){
    $rr = 'error = '.curl_error($client);
    echo "<script type='text/javascript'>alert('$rr');</script>";
}



$result = json_decode($response,true);

$output = '';
foreach ($result as $key => $val) {
    $i = $val['id'];
    $date = $val['date'];
    $n = $val['name'];
    $u = $val['url'];
    $des = $val['description'];

    $output .= '
  <tr>
   <td>'.$i.'</td>
   <td>'.$date.'</td>
   <td>'.$n.'</td>
   <td>'.$u.'</td>
   <td>'.$des.'</td>
   <td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$i.'">Edit</button></td>
   <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$i.'">Delete</button></td>
  </tr> ';
}

echo $output;

