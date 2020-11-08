<?php



class Database
{
    public $conn;
    public $stmt_user_check;
    public $stmt_insert;
    public $stmt_update;
    public $pdo;
    public $user;
    public $pass;
    function __construct($pdo,$user,$pass)
    {
        $this->pdo=$pdo;
        $this->user=$user;
        $this->pass=$pass;
    }

    function init(){
        try{
            $this->conn=new PDO($this->pdo,$this->user,$this->pass);



        } catch(PDOException $e){
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function loginCheck($user,$pass)
    {
        $this->stmt_user_check=
            $this->conn->prepare(
                "select * from users where username=:username and password=:password");
        $pass=md5($pass);
        $this->stmt_user_check->bindParam(':username',$user,PDO::PARAM_STR);
        $this->stmt_user_check->bindParam(':password',$pass,PDO::PARAM_STR);
        $this->stmt_user_check->execute();
        
        return $this->stmt_user_check->rowCount()>0?true:false;
    }

    function addMessage($content,$isread){
        $this->stmt_insert=
            $this->conn->prepare(
                "insert into message (content,isread) values (:content,:isread)");
        $this->stmt_insert->bindParam(':content',$content,PDO::PARAM_STR);
        $this->stmt_insert->bindParam(':isread',$isread,PDO::PARAM_INT);
        $this->stmt_insert->execute();
    }

    function readMessage($id){
        $this->stmt_update=
            $this->conn->prepare(
                "update message set isread=1 where id=:id");
        $this->stmt_update->bindParam(':id',$id,PDO::PARAM_INT);
        $this->stmt_update->execute();
    }

    function viewMessage(){

        $messages=array();
        $stmt=$this->conn->prepare("select * from message where isread=0");
        $stmt->execute();
        while($row=$stmt->fetch()){
            $messages[]=$row[1];
            $this->readMessage($row[0]);
        }
        return $messages;
    }
}