<?php

// Access functions
// Declare class to access this php file
class access{
    // Global connection variables
    var $serverHost = null;
    var $username = null;
    var $password = null;
    var $dbName = null;
    var $connection = null;
    var $result = null;

    // Construction function for class
    function __construct($dbhost, $dbuser, $dbpass, $dbname){
        // Use oop procedure to declare instance of global variables
        $this->serverHost = $dbhost;
        $this->username = $dbuser;
        $this->password = $dbpass;
        $this->dbName = $dbname;
    }

    // Connection to server function
    public function connect(){
        // This will store our connection to the database as a var called connection
        $this->connection = new mysqli($this->serverHost, $this->username, $this->password, $this->dbName);

        if(mysqli_connect_errno()){
            echo"Could not connect to the database";
        }
        else {
            // Allow all languages
            $this->connection->set_charset("utf8");
        }
    }

    // Dissonnection to server function
    public function dissconnect(){
        if($this->connection != null) {
            $this->connection->close();
        }
    }

    // Insert user detial to the database
    public function registerUser($username, $firstName, $lastName, $email ,$securedPassword, $phoneNumber, $streetAddress, $cityName, $zipNumber, $stateLetters){
        // INSERT INTO users SET   This is SQL syntax and "users" in the table name
        $sql ="INSERT INTO ecomUsers SET username =?, firstName=?, lastName=?, email=?, securedPassword=?, phoneNumber=?, streetAddress=?, cityName=?, zipNumber=?, stateLetters=?";
        // Store query result in statement var
        $statement = $this->connection->prepare($sql);

        //Check for statment
        if(!$statement){
            throw new Exception($statement->error);
        }
        // Bind as strings with all 5 variables - prepairing
        $statement->bind_param("ssssssssss", $username, $firstName, $lastName, $email ,$securedPassword, $phoneNumber, $streetAddress, $cityName, $zipNumber, $stateLetters);

        $returnValue = $statement->execute();

        return $returnValue;
    }

    // Select user data via usernames in database
    public function getUser($username){
        // Select INTO users SET   This is SQL syntax and "users" in the table name
        // http://php.net/manual/en/function.mysql-fetch-array.php
        // CHANGE FROM .... WHERE   to .... is the database table name
        $sql = "SELECT * FROM ecomUsers WHERE username='".$username."'";
        // Assign result from $sql into $result var
        $result = $this->connection->query($sql);

        // If at least one result is returned from the database
        if($result != null && mysqli_num_rows($result) >= 1)
        {
            // Store all selected data in result to the $row var
            $row = $result->fetch_array(MYSQLI_ASSOC);

            if(!empty($row))
            {
                $returnArray = $row;
            }
        }

        return $returnArray;
    }
}

?>
