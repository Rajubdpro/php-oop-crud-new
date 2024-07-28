<?php
class Database{
    // Connection
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'template';
    private $conn;

    /*
     * Construct
     */
    public function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error){
            echo "Connection Error";
        }else{
            $this->conn;
        }
    }// End construct


    /*
     * Insert Data
     */
    public function InsertData($_post){
        $name = $_post['name'];
        $email = $_post['email'];
        $phone = $_post['phone'];
        $subject = $_post['subject'];
        $message = $_post['message'];
        $sql = "INSERT INTO form_data(name, email, phone, subject, message) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
        $result = $this->conn->query($sql);
        if ($result){
            header("location:index.php?msg=ins");
        }// If Closed
    }// Closed Insert Data


    // Display Data
    public function DisplayData(){
        $sql = "SELECT * FROM form_data";
        $result = $this->conn->query($sql);
        if ($result->num_rows>0){
            while ($row = $result->fetch_assoc()){
                $data[] = $row;
            }// While Close
            return $data;
        }
    }// End Display Data


    // Delete Data
    public function DeleteDat($deleid){
        $sql = "DELETE FROM form_data WHERE id= '$deleid'";
        $result = $this->conn->query($sql);
        if ($result){
            header('location:index.php?msg=del');
        }
    }// End Delete Data

    // Display Data by id or edit
    public function DisplayDataById($editid){
        $sql = "SELECT * FROM form_data WHERE id='$editid'";
        $result = $this->conn->query($sql);
        if ($result->num_rows==1){
            $row = $result->fetch_assoc();
            return $row;
        }
    }// End Display Data By Id


    /*
 * Insert Data
 */
    public function UpdateData($_post){
        $name = $_post['name'];
        $email = $_post['email'];
        $phone = $_post['phone'];
        $subject = $_post['subject'];
        $message = $_post['message'];
        $id = $_post['hid'];
       $sql = "UPDATE form_data SET name = '$name', email='$email', phone = '$phone', subject = '$subject', message = '$message' WHERE id='$id'";
       $result = $this->conn->query($sql);
       if ($result){
           header('location:index.php?msg=ups');
       }
    }// Closed Update Data


















}