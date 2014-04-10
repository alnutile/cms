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
    Then I should see "This will be your home page"

  Scenario: Admin can edit a page
    Given I am on "/admin/pages"
    And I wait
    And I follow "page-id-3"
    And I wait
    Then I should see "Edit Page: Contact Page"
    And I fill in "title" with "New Contact Title"
    And I press "Update"
    And I wait
    Then I should see "Page Updated New Contact Title"
    Given I am on "/admin/pages"
    Then I should see "New Contact Title"

  #Scenario: Admin can see SLUG but non admin can not
  #Scenario: Admin can add page but non admin can not