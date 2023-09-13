<?php

namespace App\Form;

use App\Entity\Offres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('anneesexperience')
            ->add('offrename')
            ->add('connaisance')
            ->add('critere')
            ->add('experiencerequise')
            ->add('formation')
            ->add('langue')
            ->add('mission')
            ->add('onmbres_recruteur')
            ->add('salaire')
            ->add('specialite')
            ->add('tacheprincipale')
            ->add('ville')
            ->add('nameentreprise')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offres::class,
        ]);
    }
}
