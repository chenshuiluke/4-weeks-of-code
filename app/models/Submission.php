<?php
namespace App\Models;

use App\Models\Model;
use App\Util\DatabaseUtilities;

class Submission extends Model
{
    public function __construct($id, $name, $description, $picture, $demo, $code, $user_id){
        $this->set('id', $id);
        $this->set('name', $name);
        $this->set('description', $description);
        $this->set('picture', $picture);
        $this->set('demo', $demo);
        $this->set('code', $code);
        $this->set('user_id', $user_id);
    }

    public static function all(){
        $submissions = [];
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare('SELECT * FROM submission ORDER BY id DESC;');

        $result = $statement->execute();
        if($result){
            while($row = $statement->fetch(\PDO::FETCH_ASSOC)){
                $submission = new Submission($row['id'], $row['name'], $row['description'], $row['picture'], 
                    $row['demo'], $row['code'], $row['user_id']);
                array_push($submissions, $submission);
            }
        }
        return $submissions;

    }

    public static function newInDB($name, $description, $picture, $demo, $code, $user_id){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare('INSERT INTO submission (name, description, 
        picture, demo, code, user_id) VALUES(:name, :description, :picture, :demo, :code,:user_id);');

        $result = $statement->execute([
            ':name' => $name,
            ':description' => $description,
            ':picture' => $picture,
            ':demo' => $demo,
            ':code' => $code,
            ':user_id' => $user_id
            ]);

        return self::find($name);
    }

    public static function find($name){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare('SELECT * FROM submission WHERE name=:name');
        $statement->bindParam(':name', $name);
        $result = $statement->execute();

        if($result){
            $submission_obj = $statement->fetch(\PDO::FETCH_ASSOC);
            //var_dump($submission_obj);
            if($submission_obj){
                return new Submission($submission_obj['id'], $submission_obj['name'], $submission_obj['description'], 
                $submission_obj['picture'], $submission_obj['demo'], $submission_obj['code'], $submission_obj['user_id']);
            }
            return null;
        }
        return null;
    }

    public function delete(){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare('DELETE FROM submission WHERE id=:id');
        $id = $this->get('id');
        $statement->bindParam(':id', $id);
        
        $result = $statement->execute();
        return $result;
    }

    public static function findById($id){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare('SELECT * FROM submission WHERE id=:id');
        $statement->bindParam(':id', $id);
        $result = $statement->execute();

        if($result){
            $submission_obj = $statement->fetch(\PDO::FETCH_ASSOC);
            //var_dump($submission_obj);
            if($submission_obj){
                return new Submission($submission_obj['id'], $submission_obj['name'], $submission_obj['description'], 
                $submission_obj['picture'], $submission_obj['demo'], $submission_obj['code'], $submission_obj['user_id']);
            }
            return null;
        }
        return null;
    }
}
?>