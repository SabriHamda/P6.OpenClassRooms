<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Form\Type;

use App\Domain\DTO\ResetPasswordDoDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ResetPasswordDoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mot de passe ne sont pas identiques',
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
                'error_bubbling' => true
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ResetPasswordDoDTO::class,
            'empty_data' => function (FormInterface $form) {
                return new ResetPasswordDoDTO(
                    $form->get('password')->getData()
                );
            },
            'validation_groups'=> ['ResetPasswordDoDTO']
        ));
    }

}