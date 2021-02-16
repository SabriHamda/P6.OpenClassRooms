<?php
/**
 * This file is part of the Symfony P6.SnowTricks project.
 *
 * (c) Sabri Hamda <sabri@hamda.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Domain\DTO\ImagesDTO;

class ImagesType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->trick = $options['trick'];
        $builder
            ->add('image', CollectionType::class, [
                'entry_type' => FileType::class,
                'entry_options' => array('label' => false),
                'prototype' => true,

            ]);
}
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ImagesDTO::class,
            'trick'=> null,
            'empty_data' => function (FormInterface $form) {
                return new ImagesDTO(
                    $form->get('image')->getData()
                );
            },
        ));
    }

}