<?php
class ModelClients extends ModelDB
{
    public function checkClients($param)
    {
            $id = $this->pdo->quote(($param['id']));
            $sql = "SELECT hash, role FROM clients WHERE id=".$id;
            $data = $this->selectQuery($sql);
            return $data;
    }

    /**
     * Registretion - add client to DB
     * @param $param
     * @return int
     */
    public function addClient($param)
    {
        if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
        {
            return ERR_LOGIN_NAME;
        }
        if(strlen($_POST['login']) < 3 || strlen($_POST['login']) > 30)
        {
            return ERR_LOGIN_LEN;
        }
        $firstName = $this->pdo->quote(trim($_POST['first_name']));
        $lastName = $this->pdo->quote(trim($_POST['last_name']));
        $login = $this->pdo->quote($param['login']);
        $pass = md5(md5(trim($_POST['pass'])));
        $pass = $this->pdo->quote($pass);
        $sql = "INSERT INTO clients (first_name, last_name, login, pass) VALUES (".$firstName.", ".$lastName.", ".$login.", ".$pass.")";
        $result = $this->insertQuery($sql);
        if ($result === false)
        {
            return ERR_LOGIN;
        }
        return $result;
    }

    public function loginClient($param)
    {
        $pass = md5(md5(trim($param['pass'])));
        $login = $this->pdo->quote($param['login']);
        $firstName ='';
        $role = '';
        $sql = "SELECT id, first_name, pass, role FROM clients WHERE login=".$login;
        $data = $this->selectQuery($sql);
        if (is_array($data))
        {
            foreach ($data as $val)
            {
                if ($pass !== $val['pass'])
                {
                    return ERR_AUTH;
                }
                else
                {
                    $id = $this->pdo->quote($val['id']);
                    $firstName = $val['first_name'];
                    $role = $val['role'];
                }
            }
        }
        $hash = $this->pdo->quote(md5($this->generateHash(10)));
        $sql = "UPDATE clients SET hash=".$hash." WHERE id=".$id;
        $count = $this->insertQuery($sql);
        if ($count === false)
        {
            return ERR_QUERY;
        }
        $id = trim($id, "'");
        $hash = trim($hash, "'");
        $arrRes = ['id'=>$id, 'first_name'=>$firstName, 'hash'=>$hash, 'role'=>$role];
        return $arrRes;
    }

    /**
     * random hash generate for user
     * @param int $length
     * @return string
     */
    function generateHash($length=6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length)
        {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
}