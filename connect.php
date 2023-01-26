<?php 
    function connect() {
        try
        { 
            $conn = mysqli_connect("localhost", "username", "1234", "facebuk") or die ('Sorry, cannot connect to MySQL<br>');  
            return $conn; 
        } 
        catch (exception $e) 
        { 
            return false;
        }     
    }
?>