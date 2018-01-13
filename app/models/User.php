<?php
namespace App\Models;

use App\Util\DatabaseUtilities;
use App\Models\Model;
class User extends Model
{
    public static function getTable(){
        return 'users';
    }

    public static function getFields(){
        return ['id', 'email', 'username'];
    }

    public static function checkIfExists($username){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare("SELECT COUNT(username) FROM users WHERE username=:username;");
        $statement->bindParam(':username', $username);
        $result = $statement->execute();
        
        $count = (int)$statement->fetch()[0];
        //var_dump($count);
        if($count > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public static function new($username, $email, $save = false){
        $result = false;
        if($save){
            $pdo = DatabaseUtilities::getPDOInstance();
            $statement = $pdo->prepare("INSERT INTO users(username, email) VALUES (:username, :email);");
            $statement->bindParam(':username', $username);
            $statement->bindParam(':email', $email);
            $result = $statement->execute();
            //var_dump($result);
        }
        if($result || !$save){
            $user = new User();
            $user->set('username', $username);
            $user->set('email', $email);
            return $user;
        }
        return null;
    }

    public static function find($username){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare("SELECT * FROM users WHERE username=:username");

        $statement->bindParam(':username', $username);

        $result = $statement->execute();

        if($result){
            $user_obj = $statement->fetch(\PDO::FETCH_ASSOC);
            return self::new($user_obj['username'], $user_obj['email']);
        }
        return null;
    }
}
?>