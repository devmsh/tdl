Feature: XYZ
    Scenario: we have the minimum candidates for course.
        Given we have a course "PHP"
        And the "min" candidates "10"
        When "10" trainees join the course
        Then course "PHP" must be "ready"

