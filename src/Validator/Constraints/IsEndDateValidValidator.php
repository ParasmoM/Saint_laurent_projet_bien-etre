<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsEndDateValidValidator extends ConstraintValidator
{
    public function validate($protocol, Constraint $constraint)
    {
        if ($protocol->getEndDate() <= $protocol->getStartDate()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('end_date')
                ->addViolation();
        }
    }
}
