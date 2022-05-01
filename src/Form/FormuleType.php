<?php

namespace App\Form;

use App\Entity\Formule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('fraisAdhesion')
            ->add('tarifMensuel')
            ->add('partSociale')
            ->add('depotGarantie')
            ->add('caution')
            ->add('abonnes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formule::class,
        ]);
    }
}
