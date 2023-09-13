<?php

namespace App\Form;

use App\Entity\Registration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Offres;

use App\Entity\Stage;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateregistration')
            ->add('statut')
            ->add('registrationstage', EntityType::class, ['class' => Stage::class, 'choice_label' => 'titredestage', 'label' => 'titredestage'])
            ->add('registoffre', EntityType::class, ['class' => Offres::class, 'choice_label' => 'offrename', 'label' => 'offrename']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Registration::class,
        ]);
    }
}
