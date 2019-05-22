<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration('Prénom', 'John'))
            ->add('lastName', TextType::class, $this->getConfiguration('Nom', 'Doe'))
            ->add('alias', TextType::class, $this->getConfiguration('Pseudonyme', 'Marty'))
            ->add('email', EmailType::class, $this->getConfiguration('Email', 'John-Doe@gmail.com'))
            ->add('hash', PasswordType::class, $this->getConfiguration('Mot de passe', 'Entrez votre mot de passe'))
            ->add('passwordConfirm', TextType::class, $this->getConfiguration('Confirmation du mot de passe', 'Confirmez votre mot de passe'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
