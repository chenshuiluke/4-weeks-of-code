<?php
namespace App\Controllers;

use \App\Views\HomeView;
use App\Util\DatabaseUtilities;
use App\Config;
use App\Models\User;
use App\Models\Submission;
use OAuth\OAuth2\Service\GitHub;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

class HomeController extends BaseController
{
    public static function index(){
        $_SESSION['submissions'] = Submission::all();
        // var_dump($_SESSION['submissions']);
        $uriFactory = new \OAuth\Common\Http\Uri\UriFactory();
        $currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
        $currentUri->setQuery('');

        $storage = new Session();
        $servicesCredentials = Config::$servicesCredentials;
        $credentials = new Credentials(
            $servicesCredentials['github']['key'],
            $servicesCredentials['github']['secret'],
            $currentUri->getAbsoluteUri()
        );
        $serviceFactory = new \OAuth\ServiceFactory();

        $gitHub = $serviceFactory->createService('GitHub', $credentials, $storage, array('user'));
        if (!empty($_GET['code'])) {
            // This was a callback request from github, get the token
            $gitHub->requestAccessToken($_GET['code']);
            $user = json_decode($gitHub->request('user'), true);
            // var_dump($user);
            $email = self::escapeInput($user['email']);
            $name = self::escapeInput($user['name']);
            $username = self::escapeInput($user['login']);
            $avatar = self::escapeInput($user['avatar_url']);
            // echo 'The first email on your github account is ' . $email;
            // echo '<br/>';
            // echo 'Your name is ' . $name;
            // echo '<br/>';
            // echo 'Your username is ' . $username;
            // var_dump($username);
            $user = null;
            if(!User::checkIfExists($username)){
                $user = User::newInDB($username, $email, $avatar);
            }
            else{
                $user = User::find($username);
            }

            if(isset($user)){
                $_SESSION['user'] = $user;
            }            
            return self::redirect();
            
        } elseif (!empty($_GET['go']) && $_GET['go'] === 'go') {
            $url = $gitHub->getAuthorizationUri();
            header('Location: ' . $url);
        } else {
            $url = $currentUri->getRelativeUri() . '?go=go';
            self::include_view('home', ['github_login_url' => $url]);
        }
        
    }
}
?>