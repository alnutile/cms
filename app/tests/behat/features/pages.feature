@javascript @pages
Feature: Testing Pages

  Scenario: Pages CRUD
    Given I am on "/logout"
    Given I am on "/login"
    And I fill in "email" with "alfrednutile@gmail.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"
    Given I am on "/pages"
    And I wait
    Then I should see "Home Page"
    And I follow "page-id-3"
    And I wait
    Then I should see "Edit Page: Contact Page"
    And I fill in "title" with "New Contact Title"
    And I press "Update"
    And I wait
    Then I should see "Page Updated"
    Given I am on "/pages"
    And I wait
    Then I should see "New Contact Title"
    Given I am on "/pages"
    And I wait
    And I follow "page-id-3"
    And I wait
    Then I should see "The url must start with /"
    Given I am on "/logout"
    Given I am on "/login"
    And I fill in "email" with "test3@gmail.com"
    And I fill in "password" with "password"
    And I press "Login"
    And I wait
    Given I am on "/pages"
    And I wait
    And I follow "page-id-3"
    And I wait
    Then I should not see "The url must start with /"
  #Scenario: Admin can add page but non admin can not
