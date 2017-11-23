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

    private $countUserBase;

    /**
     * FeatureContext constructor.
     */
    public function __construct()
    {
        $this->htppClient = new Client();
    }

    public function before(BeforeScenarioScope $scenarioScope)
    {
        $this->countUserBase = count(User::all());
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

        $user = new User(['name' => 'admin1', 'username' => 'admin1', 'email' => 'admin1@gmail.com', 'role_id' => 1, 'password' => 'admin1']);
        $user->save();
        $book = new Task(['user_id' =>$user['id'], 'title' => 'Mon Titre', 'description' => 'C\'est ma description à moi', 'status' => 1]);
        $book->save();
        if ($book){
            $user->delete();
            return ('book created');
        }else{
            $user->delete();
            return throwException('No book');
        }


    }

    /**
     * @Then I should have one book
     */
    public function iShouldHaveOneBook()
    {
        $book = Task::all();
        if ($book === 1 ){
            return ('book 1');
        }else{
            return throwException('no book at all');
        }
    }

    /**
     * @When I delete an user
     */
    public function iDeleteAnUser()
    {
        $user = new User(['name' => 'admin1', 'username' => 'admin1', 'email' => 'admin1@gmail.com', 'role_id' => 1, 'password' => 'admin1']);
        $user->save();
        $userId = $user['id'];
        $user->delete();
        if (User::find($userId) === null){
            return ('User is delete');
        }else{
            return throwException('User survive');
        }
    }

    /**
     * @Then User is delete
     */
    public function userIsDelete()
    {
        $user = User::all();
        if (count($user) > $this->countUserBase ){
            return ('user survive');
        }else{
            return throwException('We deleted this guys');
        }
    }

    /**
     * @When I update an user
     */
    public function iUpdateAnUser()
    {
        $user = new User(['name' => 'admin1', 'username' => 'admin1', 'email' => 'admin1@gmail.com', 'role_id' => 1, 'password' => 'admin1']);
        $user->save();
        $userId = $user['id'];
        $userFind = User::find($userId);
        $userFind['name']='adminUpdate';
        $userFind->save();
        if ($userFind['name'] === 'adminUpdate'){
            $user->delete();
            return ('User is update');
        }else{
            $user->delete();
            return throwException('User not change');
        }
    }

    /**
     * @Then User is update
     */
    public function userIsUpdate()
    {
        $user = new User(['name' => 'admin1', 'username' => 'admin1', 'email' => 'admin1@gmail.com', 'role_id' => 1, 'password' => 'admin1']);
        $user->save();
        $userId = $user['id'];
        $userFind = User::find($userId);
        $userFind['name']='adminUpdate';
        $userFind->save();
        if ($userFind['name'] === 'adminUpdate'){
            $user->delete();
            return ('User is update');
        }else{
            $user->delete();
            return throwException('User not change');
        }
    }


}
