<?php
namespace App\Models;

use App\Util\DatabaseUtilities;
use App\Models\Model;
class User extends Model
{
    public function __construct($username, $email, $avatar, $id){
        $this->set('username', $username);
        $this->set('email', $email);
        $this->set('avatar', $avatar);
        $this->set('id', $id);
    }
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

    public static function newInDB($username, $email, $avatar){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare("INSERT INTO user(username, email, avatar_url) VALUES (:username, :email, :avatar);");
        $statement->bindParam(':username', $username);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':avatar', $avatar);
        $result = $statement->execute();
        return self::find($username);
    }

    public static function find($username){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare("SELECT * FROM user WHERE username=:username");

        $statement->bindParam(':username', $username);

        $result = $statement->execute();

        if($result){
            $user_obj = $statement->fetch(\PDO::FETCH_ASSOC);
            if($user_obj){
                //var_dumpvar_dump($user_obj);
                $user = new User($user_obj['username'], $user_obj['email'], $user_obj['avatar_url'], $user_obj['id']);
                //var_dump($user);
                return $user;
            }
            return null;
        }
        return null;
    }

    public static function findById($id){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare("SELECT * FROM user WHERE id=:id");

        $statement->bindParam(':id', $id);

        $result = $statement->execute();

        if($result){
            $user_obj = $statement->fetch(\PDO::FETCH_ASSOC);
            if($user_obj){
                //var_dumpvar_dump($user_obj);
                $user = new User($user_obj['username'], $user_obj['email'], $user_obj['avatar_url'], $user_obj['id']);
                //var_dump($user);
                return $user;
            }
            return null;
        }
        return null;
    }    
}
?>