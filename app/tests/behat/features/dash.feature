@javascript
Feature: Testing the Dash

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
    And I follow "user-id-2"
    Then I should see "Administer a user"
    Then I fill in "email" with ""
    And I press "Submit"
    And I wait
    Then I should see ""
