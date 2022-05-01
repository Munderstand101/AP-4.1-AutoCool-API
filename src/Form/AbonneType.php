<?php

namespace App\Form;

use App\Entity\Abonne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('rue')
            ->add('ville')
            ->add('codePostal')
            ->add('tel')
            ->add('telMobile')
            ->add('email')
            ->add('numPermis')
            ->add('lieuPermis')
            ->add('datePermis')
            ->add('paiementAdhesion')
            ->add('paiementCaution')
            ->add('ribFourni')
            ->add('formule')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonne::class,
        ]);
    }
}
