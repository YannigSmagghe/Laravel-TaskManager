<?php

use App\Task;
use App\User;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\Facades\Auth;
use Laracasts\Behat\Context\DatabaseTransactions;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * @var Client
     */
    private $htppClient;

    /**
     * FeatureContext constructor.
     */
    public function __construct()
    {
        $this->htppClient = new Client();
    }

    public function after(AfterScenarioScope $scope){
        $this->artisan('migrate:rollback');

    }


    /**
     * @Given I fill in the following
     */
    public function iFillInTheFollowing()
    {
        $user = new User(['id' => 10, 'name' => 'admin1', 'username' => 'admin1', 'email' => 'admin1@gmail.com', 'role_id' => 1, 'password' => 'admin1']);
        $userLogged = Auth::loginUsingId(10);

        if ($userLogged){
            return ('logged');
        }else{
            return ('dont log');
        }
    }

    /**
     * @Then I should be logged
     */
    public function iShouldBeLogged()
    {
        return ('success log');
    }




    /**
     * @When I create a Book
     */
    public function iCreateABook()
    {

        $book = new Task(['id' => 2, 'user_id' => 2, 'title' => 'Mon Titre', 'description' => 'C\'est ma description à moi', 'status' => 1]);
        $book->save();
        if ($book){
            return ('book created');
        }else{
            return ('no book');
        }


    }

    /**
     * @Then I should have one book
     */
    public function iShouldHaveOneBook()
    {
        $request = $this->htppClient->get('127.0.0.1:8000/tasks');
//        dd($request);
//        dd($request->getBody()->getContents());
//        if (count()) {
//            echo('A successfully created status code must be returned');
//        } else {
//            echo($request->getStatusCode());
//        }
    }

}
