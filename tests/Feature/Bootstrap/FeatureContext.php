<?php

namespace Tests\Feature\Bootstrap;

use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Event\FeatureEvent;
#This will be needed if you require "behat/mink-selenium2-driver"
#use Behat\Mink\Driver\Selenium2Driver;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit_Framework_Assert as PHPUnit;
use Auth;
use Laracasts\Behat\Context\Migrator;
use Laracasts\Behat\Context\DatabaseTransactions;
use Artisan;
use Laracasts\Behat\ServiceContainer\LaravelBooter;
use Domains\Admin\Repositories\AdminRepositoryEloquent;
use Behat\Mink\Session;
/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext {

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct() {
        putenv('APP_ENV=behat');
        $laravelBooter = new LaravelBooter(__DIR__ . '/../../../');
        $laravelBooter->boot();
    }

    /** @BeforeFeature  */
    public static function setupFeature() {
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    /** @AfterFeature */
    public static function teardownFeature() {
        Artisan::call('migrate:rollback');
    }

    /**
     * @Given I have not logged in
     */
    public function iHaveNotLoggedIn() {
        //nothing
    }

    /**
     * @Given I have logged in
     */
    public function iHaveLoggedIn() {
        $user = AdminRepositoryEloquent::where('email', 'hoang@gmail.com')->first();
        Auth::login($user);
//        $selenium2Driver = new Behat\Mink\Driver\Selenium2Driver();
//        $session = new \Behat\Mink\Session($selenium2Driver);
//        $session->start();
//        if ($this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
//            Auth::loginUsingId(1);
//            $this->visit('http://encoder.dev');
//        }
    }

    /**
     * @Then /^(?:|I )should be redirect to "(?P<page>[^"]+)"$/
     */
    public function iShouldBeRedirectTo($page) {
        $this->assertPageAddress($page);
    }

    /**
     * @Given a super user called :arg1 exists
     */
    public function aSuperUserCalledExists($arg1) {
        throw new PendingException();
    }

    /**
     * @Given a member called :arg1 exists
     */
    public function aMemberCalledExists($arg1) {
        throw new PendingException();
    }

    /**
     * @Given /^I am logged in as "([^"]*)"$/
     */
    public function iAmLoggedInAs($email) {
        die('dkm');
        // Destroy the previous session
        if (Session::isStarted()) {
            Session::regenerate(true);
        } else {
            Session::start();
        }
        // Login the user and since the driver and this code now
        // share a session this will also login the driver session
        $user = AdminRepositoryEloquent::where('email', $email)->first();
        Auth::login($user);

        // Save the session data to disk or to memcache
        Session::save();

        // Hack for Selenium
        // Before setting a cookie the browser needs to be launched
        if ($this->getSession()->getDriver() instanceof \Behat\Mink\Driver\Selenium2Driver) {
            $this->visit('login');
        }

        // Get the session identifier for the cookie
        $encryptedSessionId = Crypt::encrypt(Session::getId());
        $cookieName = Session::getName();

        // Set the cookie
        $minkSession = $this->getSession();
        $minkSession->setCookie($cookieName, $encryptedSessionId);
    }

}
