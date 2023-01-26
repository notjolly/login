<?php 
    include "connect.php";
    class User {
        public $username;
        public $name;
        public $email;
        public $password;
        public $id;

        function __construct($id,$email,$password,$name, $username, $level, $profilePic){
            $this->id=$id;
            $this->email = $email;
            $this->password = $password;
            $this->name = $name;
            $this->username = $username;
            $this->level = $level;
            $this->profilePic = $profilePic;
        }

        static function login($email, $password) {
            $conn = connect();
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if ($num ==1){
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password,$row['password'])){
                    return new User($row["id"], $row['email'], $row['password'], $row['name'], $row['username'], $row["level"],$row["profilePic"]);
                }
            }
            return false;
        }
        
        static function load_by_id($id) {
            $conn = connect();
            $sql = "SELECT * FROM users WHERE id=".$id;
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            return new User($row["id"], $row['email'], $row['password'], $row['name'], $row['username'], $row["level"],$row["profilePic"]);
        }

        function add(){
            $conn = connect();
            unset($_SESSION['username_error']);
            unset($_SESSION['email_error']);

            $sql = "SELECT * FROM users WHERE email = '$this->email'";
            $em_result = mysqli_query($conn,$sql);
            $emails = mysqli_num_rows($em_result);
            $sql2 = "SELECT * FROM users WHERE username = '$this->username'";
            $un_result = mysqli_query($conn,$sql2);
            $usernames = mysqli_num_rows($un_result);

            if ($emails ==1){
                $_SESSION['email_error']=true;
                header("Location: signup.php");
            }
            else if ($usernames==1){
                $_SESSION['username_error']=true;
                header("Location: signup.php");
            }
            else {
            $query = "INSERT INTO users (email, password, name, username, level,profilePic) VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            $hash = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bind_param("ssssss",$this->email,$hash,$this->name, $this->username,$this->level,$this->profilePic);
            $stmt->execute();

            header("Location: login.php");
            } 
        }


        function delete(){
            $conn = connect();
            unlink($this->profilePic);
            $query = "DELETE FROM users WHERE id =?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i",$this->id);
            $stmt->execute();
            
        }


        
    }
?>