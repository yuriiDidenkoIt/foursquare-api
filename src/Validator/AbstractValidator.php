<?php

namespace App\Validator;

use InvalidArgumentException;
use Symfony\Component\Validator\Validation;

/**
 * Class AbstractValidator
 */
abstract class AbstractValidator
{
    /**
     * @param array $input
     * @param array $constraints
     *
     * @throws InvalidArgumentException;
     */
    protected function validateConstraints(array $input, array $constraints): void
    {
        $validator = Validation::createValidator();
        foreach ($constraints as $constraint) {
            $violations = $validator->validate($input, $constraint);
            if (count($violations)) {
                $firstViolation = $violations->get(0);
                $message = $firstViolation->getPropertyPath() . ' ' . $firstViolation->getMessage();

                throw new InvalidArgumentException($message);
            }
        }
    }
}