<?php

class API {

    public $connect = '';

    function __construct() {
        $this->database_connection();
    }

    //connect to database

    function database_connection() {
        try {
            $this->connect = new PDO("mysql:host=localhost;dbname=ReadingList;", "root", "");
            $m = "SUCCESSFUL CONNECTION";
            //echo "<script type='text/javascript'>console.log('$m');</script>";

        } catch(PDOException $e){
            $m = $e->getMessage();
            echo "<script type='text/javascript'>alert('database error ');</script>";

            echo "<script type='text/javascript'>alert('$m');</script>";

            exit();

        }
    }

    //get all data for display

    function fetch_all() {
        $query = "SELECT * FROM ReadingList";
        $statement = $this->connect->prepare($query);
        if($statement->execute()) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        } else {
            return "error";
        }
    }

    //get for update

    function fetch_single($id) {

        $query = "SELECT * FROM ReadingList WHERE id='".$id."'";
        $statement = $this->connect->prepare($query);
        if($statement->execute()) {
            foreach($statement->fetchAll() as $row) {
                $data['id'] = $row['id'];
                $data['date'] = $row['date'];
                $data['name'] = $row['name'];
                $data['url'] = $row['url'];
                $data['description'] = $row['description'];
            }
            return $data;
        } else {
            return "error";
        }
    }

    //update

    function update() {
        //changed first name to id
        if(isset($_POST["u_date"])) {
            $form_data = array(
                ':id'   => $_POST['u_id'],
                ':date' => $_POST['u_date'],
                ':name' => $_POST['u_name'],
                ':url' => $_POST['u_url'],
                ':description' => $_POST['u_description']
            );

            $query = "UPDATE `ReadingList` SET `date`=:date,`name`=:name,`url`=:url,`description`=:description WHERE `id`=:id";
            $statement = $this->connect->prepare($query);

            if($statement->execute($form_data)) {
                $data[] = array(
                    'success' => '1'
                );
            }
            else {
                $data[] = array(
                    'success' => '0'
                );
            }
        }
        else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }

    //insert data

    function insert() {
        if(isset($_POST["u_date"])) {
            $form_data = array(
               // ':date' => $_POST['u_date'],
                ':name' => $_POST['u_name'],
                ':url' => $_POST['u_url'],
                ':description' => $_POST['u_description']
            );

            $query = "INSERT INTO `ReadingList`(`id`, `date`, `name`, `url`, `description`) VALUES (null, null, :name, :url, :description)";
            $statement = $this->connect->prepare($query);

            if($statement->execute($form_data)) {
                $data[] = array(
                    'success' => '1'
                );
            }
            else {
                $data[] = array(
                    'success' => '0'
                );
            }
        }
        else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }


    //delete record

    function delete($id) {
        $query = "DELETE FROM ReadingList WHERE id = '".$id."'";
        $statement = $this->connect->prepare($query);
        if($statement->execute()) {
            $data[] = array(
                'success' => '1'
            );
        }
        else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }
}
