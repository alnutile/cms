  @javascript @dash
  Feature: Testing the Dash

  Background: Login to the site
    Given I am on "/logout"
    Given I am on "/login"
    And I fill in "email" with "admin@example.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"

  Scenario: I should see the user table
    Given I am on "/admin"
    Then I should see "Dashboard"
    And I should see "Use the links above to manage that site."
