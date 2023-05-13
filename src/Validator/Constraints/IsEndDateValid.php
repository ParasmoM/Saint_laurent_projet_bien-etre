<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsEndDateValid extends Constraint
{
    public $message = 'La date de fin doit être supérieure à la date de début';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
