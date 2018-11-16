<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

class MaxArrayLengthPDOConstraint extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Vous pouvez ajouter 5 fichiers maximum';

}