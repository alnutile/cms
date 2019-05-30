@javascript @user
Feature: Testing User Create

  Background: Login to the site
    Given I am on "/logout"
    Given I am on "/login"
    And I fill in "email" with "admin@example.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"

  Scenario: I should NOT see user table
    Given I am on "/logout"
    Given I am on "/users/create"
    And I wait
    Then I should see "Please Sign In"

  Scenario: I should see the user table
    Given I am on "/users"
    Then I follow "add user"
    And I wait
    Then I fill in "email" with "test@gmail.com"
    Then I fill in "password" with "testtest"
    Then I fill in "password_confirmation" with "testtest"
    Then I press "Create"
    Then I wait
    And I should see "The email has already been taken."
    And I fill in "email" with "test10@gmail.com"
    Then I fill in "password" with "testtest"
    Then I fill in "password_confirmation" with "testtest"
    And I press "Create"
    And I wait
    And I should see "User Created"
    And I am on "/users"
    Then I should see "test10@gmail.com"