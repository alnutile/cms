@javascript @feature2
Feature: Testing Pages workflow

  Background: Login to the site
    Given I am on "/logout"
    Given I am on "/login"
    And I fill in "email" with "alfrednutile@gmail.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"

  Scenario: Admin should see all pages
    Given I am on "/admin/pages"
    And I wait
    Then I should see "Manage your Main Pages here"