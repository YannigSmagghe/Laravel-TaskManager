Feature: Create Book
  in order to  create book
  we have to verify title and description aren't empty
  when we click on validate
  then a book should be created
  nice
  Scenario: Create Book Scenario
    Given I am on "/task"
    When I create a Book
    Then I should have one book