<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Variant;
use App\Entity\Color;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('stock')
            ->add('price')
            ->add('color', EntityType::class, [
                'class' => Color::class,
                'choice_label' => function($color) {
                    return $color->getName();
                  },
                'label' => 'Choose color',
                'attr' => ['class' => 'form-control',
                
              ]
            ])
            ->add('variant', EntityType::class, [
                'class' => Variant::class,
                'choice_label' => function($variant) {
                    return $variant->getName();
                  },
                'label' => 'Choose item',
                'attr' => ['class' => 'form-control',
                
              ]
            ])
            ->add('photo', FileType::class, [
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10240k',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
