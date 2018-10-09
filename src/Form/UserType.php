<?php
/**
 * Created by Sabri Hamda.
 * Date: 26.09.18
 * Time: 12:40.
 */

namespace App\Form;

use App\Domain\DTO\UserRegistrationDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('username', TextType::class,[
                'attr'=>[
                    'maxlength'=> 20,
                    'minlength'=> 4
                ]
                ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mot de passe ne sont pas identiques',
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
                'error_bubbling' => true
            ))
            ->add('image', FileType::class,[
                'label'=> null,
                'required' => false,
                'attr' => ['onchange'=>'readURL(this);'],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserRegistrationDTO::class,
            'empty_data' => function (FormInterface $form) {
                return new UserRegistrationDTO(
                    $form->get('username')->getData(),
                    $form->get('email')->getData(),
                    $form->get('password')->getData(),
                    $form->get('image')->getData()
                );
            },
            'validation_groups'=> ['UserRegistrationDTO']
        ));
    }
}
