@javascript @feature1
Feature: Testing Projects

  Scenario: Login to the site
    Given I am on "/logout"
    Given I am on "/login"
    And I fill in "email" with "alfrednutile@gmail.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"
    Given I am on "/projects"
    Then the url should match "portfolios"
    Then I am on "/admin/projects"
    And I should see "Manage Projects"
    And I wait
    And I follow "create project"
    And I wait
    Then I fill in "title" with "Project via Test 1"
    Then I fill in wysiwyg on field "body" with "Project via Test 1"
    And I check "published"
    Then I press "Create"
    Then I wait
    Then I should see "Created Project"
    And I am on "/admin/projects"
    Then I should see "Project via Test 1"
    Given I am on "/portfolios/1"
    Then I should see "Project 1"
    Then I am on "/projects/1/edit"
    And I uncheck "published"
    And I press "Update Project"
    And I am on "/portfolios/1"
    Then I should not see "Project 1"
    #check unpublished
    #order
    #set unpublished and should no see it on /index
