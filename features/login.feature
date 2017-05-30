Feature: Login


Scenario: Guest visit login page
    Given I have not logged in
    When I go to "/login"
    Then I should see "Login Form"
    Then I should see a "input[name=user_name]" element
    Then I should see a "input[name=password]" element
    Then I should see a "input[type=submit]" element
    Then I should see "© 2017 Bictweb. All rights reserved!"

Scenario: Guest login with valid account
    Given I have not logged in
    When I go to "/login"
    When I fill in "user_name" with "phatradang@gmail.com"
    When I fill in "password" with "123abc123"
    When I press "Đăng nhập"
    Then I should be on the homepage

Scenario: Admin(logged in) visit login page
    Given I have logged in
    When I go to "/login"
    Then I should be redirect to "/"