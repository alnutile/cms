@javascript @portfolio
Feature: Testing Portfolios

  Scenario: Login to the site
    Given I am on "/logout"
    Given I am on "/login"
    And I fill in "email" with "alfrednutile@gmail.com"
    And I fill in "password" with "admin"
    And I press "Login"
    And I wait
    Then I should see "You are now logged in!"
    Given I am on "/portfolios"
    And I should not see "edit"
    Then I follow "Admin Portfolios"
    And I wait
    And I should see "edit"
    And I follow "portfolio-id-1"
    And I wait
    And I fill in "slug" with "/portfolio2"
    And I press "Update Portfolio"
    And I wait
    Then I should see "The url is not unique"

#    And I follow "create portfolio"
#    And I wait
#    Then I fill in "title" with "Port 1"
#    Then I fill in wysiwyg on field "body" with "Project via Test 1"
#    Then I fill in "slug" with "/port1"
#    And I check "published"
#    Then I press "Create Portfolio"
#    Then I wait
#    And I am on "/admin/portfolios"
#    Then I wait
#    Then I wait
#    Then I wait
#    Then I wait
#    Then I wait
#    Then I should see "Port 1"
#    And I follow "Port 1"
#    And I should see "Related Projects coming soon"
    #set unpublished and should no see it on /index
