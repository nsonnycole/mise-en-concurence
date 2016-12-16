<?php

namespace Flair\CoreBundle\Features\Context;

use Behat\Behat\Context\Step;

use Behat\Mink\Exception\ResponseTextException;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Feature context.
 */
class FeatureContext extends MinkContext implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;

        $this->useContext('security', new SecurityContext());
        $this->useContext('consultation', new ConsultationContext());
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Counts the occurences ($times) of sequence of characters ($text).
     *
     * @Then /^I should see (?P<times>\d+) times "(?P<text>[^"]*)"$/
     *
     * @param string $times The number of occurences.
     * @param string $text  A string.
     *
     * @throws \Behat\Mink\Exception\ResponseTextException When the text is not found $time times.
     */
    public function iShouldSeeXTimes($times, $text)
    {
        $actual = $this->getSession()->getPage()->getText();
        $regex  = '/'.preg_quote($text, '/').'/ui';

        if (!preg_match_all($regex, $actual, $matches)) {
            $message = sprintf('The text "%s" was not found anywhere in the text of the current page.', $text);
            throw new ResponseTextException($message, $this->getSession());
        } elseif (count($matches[0]) != $times) {
            $message = sprintf('The text was found %d times instead of %d', count($matches[0]), $times);
            throw new ResponseTextException($message, $this->getSession());
        }
    }

    /**
     * @when /^(?:|I )confirm the popup$/
     */
    public function confirmPopup()
    {
        $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }

    /**
     * @Given /^I wait (\d+) seconds$/
     */
    public function iWaitSeconds($seconds)
    {
        sleep($seconds);
    }
}
