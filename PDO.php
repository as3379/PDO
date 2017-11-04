<?php

$obj = new main();

class main
{
    private $query;


    function __construct()
    {
     $this->query  = 'SELECT * FROM `accounts` where id<6 ';

    }

    function __destruct()
    {
        database::connect();


        database::runQuery($this->query);



    }


}


class database
{

    static $conn;
    static $sql;



   static function connect()
    {

        try {
            self::$conn = new PDO("mysql:host=sql1.njit.edu;dbname=as3379", "as3379", "aiYzUifB");
            // set the PDO error mode to exception
           self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<br>Connected successfully<br>";
        }
        catch(PDOException $e)
        {
            echo "<br>Connection failed: " . $e->getMessage();
        }


    }

    static function runQuery($query)
    {

        self::$sql = self::$conn ->prepare($query);
        self::$sql->execute();
        $data = self::$sql->fetchAll();
            self::$sql -> closeCursor();



        echo 'The number of record return is '.self::$sql->rowCount();

        echo '<br>';
        echo '<html>'.'<head>'. '<link rel="stylesheet" href="styles.css" type="text/css">'.'</head>'.'<table>';

                echo '<tr>'.'<td>'.'ID'.'</td>'.'<td>'.'email'.'</td>'. '<td>'.'fname'.'</td>'. '<td>'.'lname'.'</td>'. '<td>'.'phone'.'</td>'. '<td>'.'birthday'.'</td>'. '<td>'.'gender'.'</td>'. '<td>'.'password'.'</td>';

        foreach ($data as $data)
        {
            echo '<tr>'.'<td>'. $data['id'] . '</td>' . '<td>' . $data['email'] . '</td>'. '<td>'. $data['fname']. '</td>'. '<td>'. $data['lname']. '</td>'.'<td>'.$data['phone'] . '</td>'. '<td>'. $data['birthday']. '</td>' . '<td>'. $data['gender'] . '</td>' . '<td>'. $data['password']. '</td>'.'</tr>' ;

        }

        echo '</tr>';
        echo '</table>';


    }




}

