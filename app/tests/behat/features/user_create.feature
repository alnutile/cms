@javascript
Feature: Testing User Create

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
    Then I follow "Add new user"
    Then I fill in "email" with "test@gmail.com"
    Then I fill in "password" with "test@gmail.com"
    Then I fill in "password_confirmation" with "test@gmail.com"
    Then I press "Submit"
    Then I wait
    And I should see "The email has already been taken."
    And I fill in "email" with "test10@gmail.com"
    And I press "Submit"
    And I wait
    And I am on "/admin"
    Then I should see "test10@gmail.com"
