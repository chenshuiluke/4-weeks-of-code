<?php
namespace App\Controllers;

use \App\Views\HomeView;
use App\Util\DatabaseUtilities;
use App\Config;
use App\Models\Submission;
use App\Models\User;
use OAuth\OAuth2\Service\GitHub;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;
use \GuzzleHttp\Client;

class SubmissionController extends BaseController
{
    public static function index(){
        self::include_view('add-submission');
    }

    public static function showEditForm(){
        $id = $_GET['id'];
        $id = intval($id);
        $submission = Submission::findById($id);
        if(isset($submission)){
            $_SESSION['submission_to_edit'] = $submission;
            self::include_view('edit-submission');
        }
        else{
            return self::redirect();
        }
    }

    private static function validateCoinHive(){
        if(!isset($_POST['coinhive-captcha-token'])){
            return false;
        }
        $token = $_POST['coinhive-captcha-token'];
        $client = new Client();
        $response = $client->request('POST', 'https://api.coinhive.com/token/verify',
            [
                'form_params' => [
                    'token' => $token,
                    'hashes' => 1024,
                    'secret' => Config::$coinhiveSecret
                ]
            ]);
        $result = json_decode($response->getBody(), true);
        return $result['success'];
    }

    public static function view(){
        $id = $_GET['id'];
        $id = intval($id);
        $submission = Submission::findById($id);
        if(null === $submission){
            self::include_view('404');
        }
        else{
            $_SESSION['submission'] = $submission;
            // var_dump($_SESSION['submission']);
            self::include_view('submission');
        }
    }

    public static function delete(){
        $id = $_POST['id'];
        $id = intval($id);
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $submission = Submission::findById($id);
            if($submission->get('user_id') === $user->get('id')){
                $submission->delete();
            }
            else{
                return self::redirect('/unauthorized');
            }
            return self::redirect();
        }
        else{
            return self::redirect('/unauthorized');
        }
        
    }

    public static function add(){
        //var_dump($_POST);
        $_SESSION['errors_add_submission'] = [];
        $_SESSION['flashed_add_submission'] = [];
        if(!isset($_SESSION['user'])){
            self::include_view('home');
            return;
        }
        $request_keys = ['name', 'description','picture','demo', 'code'];
        $data = $_POST;

        $data = self::escapeArr($data);
        $old_flashed_data = $data;
        //var_dump($data);
        $errors = self::validateNewSubmission($data);

        if(!self::validateCoinHive()){
            array_push($errors, "Please tick and wait for the Captcha to complete.");
        }
        if(Submission::find($data['name']) !== null){
            array_push($errors, "A submission with that name already exists");
        }

        if(count($errors) > 0){
            $_SESSION['errors_add_submission'] = $errors;
            $_SESSION['flashed_add_submission'] = $old_flashed_data;   
            return self::index();         
        }

        $user = $_SESSION['user'];

        $submission = Submission::newInDB($data['name'],$data['description'], 
            $data['picture'],$data['demo'], $data['code'],$user->get('id'));

        return self::redirect();

    }

    public static function edit(){
        //var_dump($_POST);
        $original_submission = $_SESSION['submission_to_edit'];
        $user = $_SESSION['user'];

        if(!isset($original_submission)){
            return self::redirect('/unauthorized');
        }
        if(!isset($user) || $user->get('id') !== $original_submission->get('user_id')){
            return self::redirect('/unauthorized');
        }

        $_SESSION['errors_edit_submission'] = [];
        $_SESSION['flashed_edit_submission'] = [];
        if(!isset($_SESSION['user'])){
            return self::redirect();
        }
        $request_keys = ['name', 'description','picture','demo', 'code'];
        $data = $_POST;

        $data = self::escapeArr($data);
        $old_flashed_data = $data;
        //var_dump($data);
        $errors = self::validateNewSubmission($data);

        //Show name error message only if the duplicate 
        //submission name does not belong to the submission being edited.

        if(!self::validateCoinHive()){
            array_push($errors, "Please tick and wait for the Captcha to complete.");
        }
        if($original_submission->get('name') !== $data['name']){
            if(Submission::find($data['name']) !== null){
                array_push($errors, "A submission with that name already exists");
            }
        }

        if(count($errors) > 0){
            $_SESSION['errors_edit_submission'] = $errors;
            $_SESSION['flashed_edit_submission'] = $old_flashed_data;   
            $_GET['id'] = $original_submission->get('id');
            return self::showEditForm();         
        }

        $submission = $original_submission;
        $submission->set('name', $data['name']);
        $submission->set('description', $data['description']);
        $submission->set('picture', $data['picture']);
        $submission->set('demo', $data['demo']);
        $submission->set('code', $data['code']);
        $submission->save();

        return self::redirect();

    }

    private static function validateNewSubmission($data){
        $errors = [];
        if(!isset($data['name'])){
            array_push($errors, "The submission name attribute must exist");
        }
        if(strlen($data['name']) === 0){
            array_push($errors, "Your submission must have a name");
        }
        if(strlen($data['name']) > 100){
            array_push($errors, "Your submission's name can only have up to 100 characters.");
        }   

        if(!isset($data['description'])){
            array_push($errors, "The submission description attribute must exist");
        }
        if(strlen($data['description']) === 0){
            array_push($errors, "Your submission must have a description");
        }        
        if(strlen($data['description']) > 500){
            array_push($errors, "Your submission's description can only have up to 500 characters.");
        }  
        
        if(!isset($data['code'])){
            array_push($errors, "The submission code attribute must exist");
        }
        if(strlen($data['code']) === 0){
            array_push($errors, "Your submission must have a link to its code");
        }        
        if(strlen($data['code']) > 500){
            array_push($errors, "Your submission's code link can only have up to 200 characters.");
        }             

        if(isset($data['picture']) && strlen($data['picture']) > 1 && strlen($data['picture']) > 200){
            array_push($errors, "Your submission's picture link can only have up to 200 characters.");
        }

        if(isset($data['demo']) && strlen($data['demo']) > 1 && strlen($data['demo']) > 200){
            array_push($errors, "Your submission's demo link can only have up to 200 characters.");
        }        

        return $errors;
    }
}
?>