<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,['label' => 'Потребителско име'])
            ->add('password',PasswordType::class,['label' => 'Парола','required'=>false,'mapped' => false])
            ->add('name',TextType::class,['label' => 'Име'])
            ->add('roles', ChoiceType::class,
                [
                    'choices' => ['Потребител' => "ROLE_USER", 'Администратор' => "ROLE_ADMIN"],
                    'mapped' => false,
                    'expanded' => false,
                    'multiple' => false,
                    'label' => 'Роля'
                ]
            )




        ;



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,


        ]);
    }
}
