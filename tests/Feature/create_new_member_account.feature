Feature: Create new member account

Scenario: Admin(member) visit login page
    Given I am a guest
    When I go to "/register"
    Then I should be redirected to the login page

Scenario: Admin(member) visit login page
    Given I have logged in as a normal member
    When I go to "/register"
    Then I should be redirected to the home page

Scenario: Admin(logged in) visit login page
    Given I have logged in as a super admin
    When I go to "/register"
    Then I should see "Đăng ký thành viên"
    And I should see a "input[name=name]" element
    And I should see a "input[name=email]" element
    And I should see a "input[name=password]" element
    And I should see a "input[type=submit]" element