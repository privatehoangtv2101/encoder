Feature:
In order to prove that Behat works as intended
As a user, i want to test the home page for a phrase

Scenario: When user is not log in
    When I am on the homepage
    Then I should see "Login Form"
    Then I should see a "input[name=user_name]" element
    Then I should see a "input[name=password]" element
    Then I should see a "input[type=submit]" element
    Then I should see "© 2017 Bictweb. All rights reserved!"