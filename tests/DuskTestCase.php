<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

trait RunsWebServer
{
    /**
     * @var Process
     */
    protected static $webServerProcess;

    /**
     * Start the web server process
     */
    public static function startWebServer()
    {
        static::$webServerProcess = static::buildServerProcess();
        static::$webServerProcess->start();
        static::afterClass(function() {
            static::stopWebServer();
        });
    }

    /**
     * Stop the web server process
     */
    public static function stopWebServer()
    {
        if (static::$webServerProcess) {
            static::$webServerProcess->stop();
        }
    }

    /**
     * Build the process to run the web server
     *
     * @return \Symfony\Component\Process\Process
     * @throws \Symfony\Component\Process\Exception\InvalidArgumentException
     * @throws \Symfony\Component\Process\Exception\LogicException
     */
    protected static function buildServerProcess()
    {
        return (new ProcessBuilder())
            ->setTimeout(null)
            ->setWorkingDirectory(realpath(__DIR__.'/../'))
            ->add(PHP_BINARY)
            ->add('artisan')
            ->add('serve')
            ->add('--env=dusk')
            ->add('--host=127.0.0.1')
            ->add('--port=8000')
            ->getProcess();
    }
}


abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication,RunsWebServer;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startWebServer();
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless'
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
