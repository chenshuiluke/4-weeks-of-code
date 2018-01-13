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
        return ['id', 'email', 'username', 'avatar_url'];
    }

    public static function checkIfExists($username){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare("SELECT COUNT(username) FROM user WHERE username=:username;");
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

    public static function new($username, $email, $avatar, $save = false){
        $result = false;
        if($save){
            $pdo = DatabaseUtilities::getPDOInstance();
            $statement = $pdo->prepare("INSERT INTO user(username, email, avatar_url) VALUES (:username, :email, :avatar);");
            $statement->bindParam(':username', $username);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':avatar', $avatar);
            $result = $statement->execute();
            //var_dump($result);
        }
        if($result || !$save){
            $user = new User();
            $user->set('username', $username);
            $user->set('email', $email);
            $user->set('avatar', $avatar);
            return $user;
        }
        return null;
    }

    public static function find($username){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare("SELECT * FROM user WHERE username=:username");

        $statement->bindParam(':username', $username);

        $result = $statement->execute();

        if($result){
            $user_obj = $statement->fetch(\PDO::FETCH_ASSOC);
            return self::new($user_obj['username'], $user_obj['email'], $user_obj['avatar_url']);
        }
        return null;
    }
}
?>