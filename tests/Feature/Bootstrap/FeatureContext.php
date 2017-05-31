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
        ini_set('max_execution_time', 700);
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
        Auth::loginUsingId(1);
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

}
