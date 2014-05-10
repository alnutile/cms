@javascript
Feature: Testing User Edit

  Scenario: User CRUD
    Given I am on "/logout"
    Given I reset the session
    Given I am on "/login"
    And I fill in "email" with "alfrednutile@gmail.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"
    Given I am on "/users"
    Then I should see "Admin Users"
    And I should see "Test Two"
    Then I follow "test@gmail.com"
    And I wait
    Then I fill in "email" with ""
    Then I press "Update"
    Then I wait
    And I should see "The email field is required."
    And I fill in "email" with "test@gmail.com"
    And I press "Update"
    And I wait
    Then I should see "User Updated"
    Given I am on "/users"
    And I should see "Test Two"

#
#  Scenario: Test User is set in active
#    And I uncheck "user-active"
#    And I press "Submit"
#    And I wait
#    Given I am on "/users"
#    And I wait
#    And I follow "test@gmail.com"
#    And I wait
#    Then the "user-active" checkbox should not be checked
#
