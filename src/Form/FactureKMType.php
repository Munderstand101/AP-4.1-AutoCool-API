<?php

namespace App\Form;

use App\Entity\FactureKM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureKMType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tarifKM')
            ->add('formule')
            ->add('trancheKM')
            ->add('categorieVehicule')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FactureKM::class,
        ]);
    }
}
