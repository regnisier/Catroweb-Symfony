@homepage
Feature: At the bottom of every page there should be an to the user invisible version number

  Background:
    Given there are users:
      | name     | password | token      | email               |
      | Catrobat | 123456   | cccccccccc | dev1@pocketcode.org |
    And there are programs:
      | id | name      | description | owned by | downloads | apk_downloads | views | upload time      | version |
      | 1  | program 1 | p1          | Catrobat | 3         | 2             | 12    | 01.01.2013 12:00 | 0.8.5   |
    And the app version is "2.0.0"

  Scenario: version number should be on every page and themes
    Given I am on homepage
    Then the element "#app-version" should exist
    Given I am on "pocketcode/login/"
    Then the element "#app-version" should exist
    Given I am on "pocketcode/register/"
    Then the element "#app-version" should exist
    Given I am on "pocketcode/help/"
    Then the element "#app-version" should exist
    Given I am on "pocketcode/program/1"
    Then the element "#app-version" should exist
    Given I am on "pocketcode/profile/1"
    Then the element "#app-version" should exist
    Given I am on "luna"
    Then the element "#app-version" should exist

  Scenario: version number should not be visible to the user
    Given I am on homepage
    Then the element "#app-version" should exist
    And I should not see "2.0.0"