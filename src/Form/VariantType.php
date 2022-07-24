<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Variant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => function($category) {
                    return $category->getName();
                  },
                'label' => 'Choose category',
                'attr' => ['class' => 'form-control',
              ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Variant::class,
        ]);
    }
}
