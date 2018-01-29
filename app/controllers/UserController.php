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

class UserController extends BaseController
{
    public static function view(){
        $user_id = null;
        if(!isset($_GET['id'])){
            return self::unauthorized();
        }
        $user_id = intval($_GET['id']);
        $user = User::findById($user_id);
        if(!isset($user)){
            return self::redirect();
        }
        $_SESSION['user_being_viewed'] = $user;
        return self::include_view('user');
    }
}