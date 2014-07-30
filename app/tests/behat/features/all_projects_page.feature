@javascript @pages
Feature: Testing All Projects Page

  Scenario: Pages CRUD
    Given I am on "/logout"
    Given I am on "/all_projects"
    And I wait
    Then I should see "All Projects"
    And  I should see "Project 1"
    And  I should see "Project 2"
    And  I should see "read more..."
    And  I should see "»"

  #Scenario: project page that lists all projects with a pager
