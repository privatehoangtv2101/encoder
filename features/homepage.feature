Feature:
In order to prove that Behat works as intended
As a user, i want to test the home page for a phrase

Scenario: When user is not log in
    When I am on the homepage
    Then I should see "Laravel"