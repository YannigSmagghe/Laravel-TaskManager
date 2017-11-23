Feature: Sign in to the website
  In order to access the administrative interface
  As a visitor
  I need to be able to log in to the website
  Scenario: Log in user
    Given I am on "/login"
    And I fill in the following
    Then  I should be logged

  Scenario:
    Given I am on "/user"
    When I delete an user
    Then User is delete

  Scenario:
    Given I am on "/user"
    When I update an user
    Then User is update