<?php
/**
 * Created by PhpStorm.
 * User: Unit
 * Date: 1/15/2018
 * Time: 3:51 PM
 */

use Behat\Behat\Context\Context;

class CourseContext implements Context
{

    /**
     * @Given /^we have a course "([^"]*)"$/
     */
    public function weHaveACourse($courseName)
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Given /^the "([^"]*)" candidates "([^"]*)"$/
     */
    public function theCandidates($thresold, $count)
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^"([^"]*)" trainees join the course$/
     */
    public function traineesJoinTheCourse($number)
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^course "([^"]*)" must be "([^"]*)"$/
     */
    public function courseMustBe($courseName, $status)
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}