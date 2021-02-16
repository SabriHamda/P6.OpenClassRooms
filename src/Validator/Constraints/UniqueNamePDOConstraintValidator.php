<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Validator\Constraints;

use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class UniqueEmailPDOConstraintValidator
 * @package App\Validator\Constraints
 */
class UniqueNamePDOConstraintValidator extends ConstraintValidator
{
    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * This class insure that the trick is unique by finding the name in the bdd
     * UniqueNamePDOConstraintValidator constructor.
     * @param TrickRepositoryInterface $trickRepository
     */
    public function __construct(TrickRepositoryinterface $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    /**
     * Check in the bdd if the trick exist find by email
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }
        $result = $this->trickRepository->findOneBy(['name' => $value]);

        if ($result) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}