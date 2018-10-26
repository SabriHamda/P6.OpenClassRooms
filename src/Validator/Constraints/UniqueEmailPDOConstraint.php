<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class UniqueEmailPDOConstraint
 * @package App\Validator\Constraints
 */
class UniqueEmailPDOConstraint extends Constraint
{

    /**
     * @var string
     */
    public $message = 'cet utilisateur existe deja';
}