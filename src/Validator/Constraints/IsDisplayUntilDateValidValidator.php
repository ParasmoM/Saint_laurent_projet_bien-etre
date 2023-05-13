<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsDisplayUntilDateValidValidator extends ConstraintValidator
{
    public function validate($protocol, Constraint $constraint)
    {
        if ($protocol->getDisplayUntilDate() <= $protocol->getDisplayFromDate()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('display_until_date')
                ->addViolation();
        }
    }
}

