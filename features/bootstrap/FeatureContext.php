<?php

use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
#This will be needed if you require "behat/mink-selenium2-driver"
#use Behat\Mink\Driver\Selenium2Driver;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit_Framework_Assert as PHPUnit;

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
        throw new PendingException();
    }

    /**
     * @Then /^(?:|I )should be redirect to "(?P<page>[^"]+)"$/
     */
    public function iShouldBeRedirectTo($page) {
        $this->assertPageAddress($page);
    }

}
