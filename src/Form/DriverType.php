<?php

namespace App\Form;

use App\Entity\Driver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Names',TextType::class,['label' => 'Име'])
            ->add('DriverLicense',TextType::class,['label' => 'Шофьорска книжка'])
            ->add('Phone',TextType::class,['label' => 'Телефон'])
            ->add('BankName',TextType::class,['label' => 'Банка'])
            ->add('Iban',TextType::class,['label' => 'Номер на сметка'])
            ->add('Egn',TextType::class,['label' => 'ЕГН'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Driver::class,
        ]);
    }
}
