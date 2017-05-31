Feature: Login

Scenario: Guest visit login page
    Given I have not logged in
    When I go to "/login"
    Then I should see "Login Form"
    And I should see a "input[name=email]" element
    And I should see a "input[name=password]" element
    And I should see a "input[type=submit]" element
    And I should see "© 2017 Bictweb. All rights reserved!"

Scenario: Guest login with wrong password will not be able to login successfully
    Given I have not logged in
    When I go to "/login"
    And I fill in "email" with "hoang@gmail.com"
    And I fill in "password" with "not_exist"
    And I press "Đăng nhập"
    Then I should be on "/login"

Scenario: Guest login with wrong email will not be able to login successfully
    Given I have not logged in
    When I go to "/login"
    And I fill in "email" with "not_exist@gmail.com"
    And I fill in "password" with "123123"
    And I press "Đăng nhập"
    Then I should be on "/login"

Scenario: Guest login to disabled account so he can't login successfully
    Given I have not logged in
    When I go to "/login"
    And I fill in "email" with "johndoe96@gmail.com"
    And I fill in "password" with "doe1996"
    And I press "Đăng nhập"
    Then I should be on "/login"

Scenario: Guest login with valid account
    Given I have not logged in
    When I go to "/login"
    And I fill in "email" with "hoang@gmail.com"
    And I fill in "password" with "123123"
    And I press "Đăng nhập"
    Then I should be on the homepage

Scenario: Admin(logged in) visit login page
    Given I have logged in
    When I go to "/login"
    Then I should be redirect to "/"
    And I should see "Bict encoder"