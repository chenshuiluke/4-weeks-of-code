<?php
namespace App\Controllers;

use App\Views\SignupView;
use App\Util\DatabaseUtilities;
use App\Config;
use OAuth\OAuth2\Service\GitHub;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

class SignupController extends BaseController
{
    public function showSignupPage(){
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
            $result = json_decode($gitHub->request('user/emails'), true);
            echo 'The first email on your github account is ' . $result[0];
        } elseif (!empty($_GET['go']) && $_GET['go'] === 'go') {
            $url = $gitHub->getAuthorizationUri();
            header('Location: ' . $url);
        } else {
            $url = $currentUri->getRelativeUri() . '?go=go';
            echo "<a href='$url'>Login with Github!</a>";
        }
    }

    public static function processSignup(){
        $email = $_POST['email'];
        $password = $_POST['password'];

        var_dump($email);
        var_dump($password);

        $pdo = DatabaseUtilities::getPDOInstance();

        $statement = $pdo->prepare("CALL create_user(:email, :password)");
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $result = $statement->execute();

        var_dump($result);

        self::getAllSignups();
    }
    public static function getAllSignups(){
        $pdo = DatabaseUtilities::getPDOInstance();
        $statement = $pdo->prepare('CALL find_user_by_email(:email)');
        $email = "chenshuiluke@gmail.com";
        $statement->bindParam(':email', $email);

        $result = $statement->execute();
        while($row = $statement->fetch(\PDO::FETCH_ASSOC)){
            echo "{$row['email']} - {$row['password']}";
            echo "<br />";
        }
    }    
}
?>