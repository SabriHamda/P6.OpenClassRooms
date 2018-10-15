<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Form\Type;

use App\Domain\DTO\ResetPasswordDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ResetPasswordType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ResetPasswordDTO::class,
            'empty_data' => function (FormInterface $form) {
                return new ResetPasswordDTO(
                    $form->get('email')->getData()
                );
            },
            'validation_groups' => ['ResetPasswordDTO']
        ));
    }
}