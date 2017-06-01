Feature: Logout

@mink:selenium2
Scenario: Admin(logged in) visit login page
    Given I have not logged in
    When I go to "/login"
    And I fill in "email" with "hoang@gmail.com"
    And I fill in "password" with "123123"
    And I press "Đăng nhập"
    Then I should be on the homepage
    When I follow "Trần Văn Hoàng"
    Then I should see "Logout"
    When I follow "Logout"
    Then I should be on "/login"