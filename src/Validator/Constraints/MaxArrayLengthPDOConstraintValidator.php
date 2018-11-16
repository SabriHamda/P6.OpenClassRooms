<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaxArrayLengthPDOConstraintValidator extends ConstraintValidator
{
    /**
     * Check in the bdd if the user exist find by email
     * @param array $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }
        $result = count($value);

        if($result > 5){
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}