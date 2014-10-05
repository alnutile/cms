@javascript @user
Feature: Testing User Auth

  Background: Login to the site
    Given I am on "/logout"

  Scenario: User should see error message when using wrong username and password
    Given I am on "/login"
    And I fill in "email" with "TESTSETESTSE"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "Your username/password combination was incorrect"

  Scenario: User should be able to login
    Given I am on "/login"
    And I fill in "email" with "admin@example.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"