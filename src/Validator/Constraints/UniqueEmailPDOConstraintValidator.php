<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Validator\Constraints;

use App\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class UniqueEmailPDOConstraintValidator
 * @package App\Validator\Constraints
 */
class UniqueEmailPDOConstraintValidator extends ConstraintValidator
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * This class insure that the user is unique by finding the email in the bdd
     * UniqueEmailPDOConstraintValidator constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryinterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Check in the bdd if the user exist find by email
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }
        $result = $this->userRepository->findOneBy(['email' => $value]);

        if($result){
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}