<?php
class DB {

    //mysql://bc05699db98289:57857743@eu-cdbr-west-02.cleardb.net/heroku_aa3dba84661b892?reconnect=true

    private  $dbname = "heroku_aa3dba84661b892";
    private  $hostDB = "eu-cdbr-west-02.cleardb.net";
    private  $pwdBD = "57857743";
    private  $userDB = "bc05699db98289";

    private $pdo ;

    public  function  __construct()
    {
        try{
            $this->pdo = new PDO("mysql:host=".$this->hostDB."; dbname=".$this->dbname, $this->userDB, $this->pwdBD);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);


        }catch (PDOException $e)
        {
            die("Erreur survenue :" . $e->getMessage()) ;
        }
    }
    /**
     * @param $sql
     * @param bool|array $params
     * @return bool|array
     */
    public  function  myQuery($sql, $params= false)
    {
        try{
            if($params)
            {
                $req = $this->pdo->prepare($sql);
                $req->execute($params) ;
                return $req ;
            }else{
                return $this->pdo->query($sql);
            }
        }catch (PDOException $ex)

        {
            die("errors : " . $ex->getMessage()  . $ex->getLine());
        }
    }


    public static function sendMail($to, $subject, $message)
    {
        $headers = 'From: webmaster@contact.com' . "\r\n" .
            'Reply-To: webmaster@contact.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);

    }
  
}