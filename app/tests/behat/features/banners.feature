@javascript @feature1
Feature: Testing User Create

  Scenario: Login to the site
    Given I am on "/logout"
    Given I am on "/login"
    And I fill in "email" with "alfrednutile@gmail.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"
    Given I am on "/banners"
    Then I follow "create banner"
    And I wait
    Then I fill in "name" with "Banner 1"
    #Then I upload file
    Then I press "Create"
    Then I wait
    And I should see "Banner Image Required"
    And I am on "/banners"
    Then I should see "Banner 1"
    And I follow "banner-id-1"
    And I wait
    And I wait
    And I fill in "name" with "New Name"
    And I press "Update"
    And I wait
    Then I should see "Banner Updated"
    And I should see "New Name"