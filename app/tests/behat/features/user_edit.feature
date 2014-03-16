@javascript
Feature: Testing User Edit

  Background: Login to the site
    Given I am on "/logout"
    Given I am on "/login"
    And I fill in "email" with "alfrednutile@gmail.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"

  Scenario: I should see the user table
    Given I am on "/admin"
    Then I should see "Admin Users"
    Then I follow "test@gmail.com"
    Then I fill in "email" with ""
    Then I press "Submit"
    Then I wait
    And I should see "The email field is required."
    And I fill in "email" with "test@gmail.com"
    And I press "Submit"
    And I wait
    Then I should see "User has been updated..."
    And I uncheck "user-active"
    And I press "Submit"
    And I wait
    Given I am on "/admin"
    And I follow "test@gmail.com"
    Then the "user-active" checkbox should not be checked
