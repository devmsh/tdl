Feature: As a user I want to login so that I ......

    // Product owner
    Scenario: Login.
        Given there is a vaild user in the system
        When the user try to login
        Then he must be redirected to the main screen


    // Scrum Master
    Scenario: Login.
        Given A user register using "0599300163" and "132456"
        When a user login by "0599300163" and "123456"
        Then he must be redirected to the "family tree" screen

    // Testing and QA
    Scenario: success login.
        Given A user register using "0599300163" and "132456"
        When a user login by "0599300163" and "123456"
        Then he must be redirected to the "family tree" screen

    Scenario: failed login.
        Given A user register using "0599300163" and "132456"
        When a user login by "0599300163" and "123456"
        Then he must be redirected to the "family tree" screen

    Scenario: empty.
        Given A user register using "0599300163" and "132456"
        When a user login by "0599300163" and "123456"
        Then he must be redirected to the "family tree" screen
