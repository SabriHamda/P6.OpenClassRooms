<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Form\Type;

use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Repository\Interfaces\CategoryRepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Domain\Entity\Trick;

class UpdateTrickType extends AbstractType
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    private $trick;

    private $choices = [];

    /**
     * UpdateTrickType constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param Trick $trick
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->trick = $options['trick'];

        $builder
            ->add('name', TextType::class,[
                'data' => $this->trick->getName(),
            ])


            ->add('description', TextareaType::class, [
                'data' => $this->trick->getDescription(),
                'attr' => [
                    'rows' => '10',
                    'required' => true,
                ]
            ])
//            ->add('image', FileType::class, [
//                'required' => true,
//                'multiple' => true,
//                'label' => null,
//                'attr' => [
//                    'onchange' => 'readURL(this);'
//                ],
//            ])

            ->add('image', FileType::class, [
                'required' => false,
                'multiple' => true,
                'label' => null,
                'attr' => [
                    'class' => 'form-control-file'
                ],
            ])

            ->add('videos', CollectionType::class, array(
                    'entry_type' => TextType::class,
                    'prototype' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype_name' => 'videos',
                    'label' => false,
                    'required' => false,
                )

            )
            ->add('category', ChoiceType::class, array(
                'required' => true,
                'label' => false,
                'multiple' => false,
                'choices' => $this->getCategories(),
                'data' => $this->trick->getCategory()->getName(),
                'choice_translation_domain' => false



            ));



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UpdateTrickDTO::class,
            'trick'=> null,
            'empty_data' => function (FormInterface $form) {
                return new UpdateTrickDTO(
                    $form->get('name')->getData(),
                    $form->get('description')->getData(),
                    $form->get('image')->getData(),
                    $form->get('videos')->getData(),
                    $form->get('category')->getData()
                );
            },
            'validation_groups' => ['UpdateTrickDTO']
        ));
    }

    private function getCategories()
    {
        $categories = $this->categoryRepository->findAll();
        foreach ($categories as $category) {
            $this->choices[] = $category->getName();
        }

        foreach ($this->choices as $key => $value) {

            $choices[] = [$value => $value];
        }


        $merged = call_user_func_array('array_merge', $choices);
        $empty [] = ['' => ''];
        array_push($merged, array_shift($empty));
        return $this->choices = $merged;

    }
}