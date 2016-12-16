<?php

namespace Flair\CoreBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * Data transformers which transforms boolean to string.
 *
 * @author Benjamin Lazarecki <benjamin@widop.com>
 */
class BooleanToStringTransformer implements DataTransformerInterface
{
    /**
     * @var string
     */
    protected $trueValue;

    /**
     * @var string
     */
    protected $falseValue;

    /**
     * Constructor.
     *
     * @param string $trueValue  The string representation of the true value.
     * @param string $falseValue The string representation of the false value.
     */
    public function __construct($trueValue = 'yes', $falseValue = 'no')
    {
        $this->setTrueValue($trueValue);
        $this->setFalseValue($falseValue);
    }

    /**
     * Gets the string representation of the true value.
     *
     * @return string The string representation of the true value.
     */
    public function getTrueValue()
    {
        return $this->trueValue;
    }

    /**
     * Sets the string representation of the true value.
     *
     * @param string $trueValue The string representation of the true value.
     */
    public function setTrueValue($trueValue)
    {
        $this->trueValue = $trueValue;
    }

    /**
     * Gets the string representation of the false value.
     *
     * @return string The string representation of the false value.
     */
    public function getFalseValue()
    {
        return $this->falseValue;
    }

    /**
     * Sets the string representation of the false value.
     *
     * @param string $falseValue The string representation of the false value.
     */
    public function setFalseValue($falseValue)
    {
        $this->falseValue = $falseValue;
    }

    /**
     * Transforms a boolean value into his string representation.
     *
     * @param null|boolean $value The value.
     *
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException If value is not a boolean and is not null.
     *
     * @return null|string The string representation of the value.
     */
    public function transform($value)
    {
        if ($value === null) {
            return null;
        }

        if (!is_bool($value)) {
            throw new UnexpectedTypeException($value, 'boolean');
        }

        return $value ? $this->trueValue : $this->falseValue;
    }

    /**
     * Transforms a string representation into his boolean value.
     *
     * @param null|string $value The value.
     *
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException       If the given value is not a string and
     *                                                                         is not null.
     * @throws \Symfony\Component\Form\Exception\TransformationFailedException If the given value is not allowed.
     *
     * @return null|boolean Boolean representation of the value.
     */
    public function reverseTransform($value)
    {
        if ($value === null) {
            return null;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if ($value === $this->trueValue) {
            return true;
        }

        if ($value === $this->falseValue) {
            return false;
        }

        throw new TransformationFailedException(sprintf('The value "%s" is not allowed.', $value));
    }
}
