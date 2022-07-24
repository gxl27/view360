<?php

namespace App\Form;

use App\Entity\Globalsettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GlobalsettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('closeWebsite')
            ->add('frames')
            ->add('zoom')
            ->add('maxItems')
            ->add('closeRegister')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Globalsettings::class,
        ]);
    }
}
