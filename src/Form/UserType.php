<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [ // Use ChoiceType for roles
                'choices' => [ // Provide the roles choices as an array
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    // Add other roles as needed
                ],
                'multiple' => true, // Allow multiple role selection
                'expanded' => true, // Display roles as checkboxes
            ])
            ->add('password')
            ->add('username')
            ->add('age')
            ->add('nom')
            ->add('prenom')
            ->add('poste')
            ->add('telephone');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
