Feature: Login

Scenario: Admin(logged in) visit login page
    Given I have logged in
    And I am on the homepage
    When I follow "Logout"
    Then I should be on "/login"