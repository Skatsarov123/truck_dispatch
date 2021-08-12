<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Customer;
use App\Entity\Driver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;


class BookingType extends AbstractType
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('status',EntityType::class,array('class'=>'App\Entity\Status','label' => 'Статус'))
            ->add('drivers', EntityType::class, [
                'class' => Driver::class,
                'label' => "Шофьор",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->innerJoin('app\Entity\User','u')
                        ->where('d.company= :ucompany')
                        ->setParameter('ucompany',$user = $this->security->getUser())
                      ;
                },
            ])
            ->add('truck',EntityType::class,array('class'=>'App\Entity\Truck','label' => 'Рег.номер камион '))
            ->add('trailer',EntityType::class,array('class'=>'App\Entity\Trailer','label' => 'Рег.номер ремарке'))
            ->add('customer', EntityType::class,[
                'class'=>'App\Entity\Customer',
                'label' => "Клиент",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('cr')
                        ->innerJoin('app\Entity\Customer','c')
                        ->where('cr.customerCompany= :company')
                        ->setParameter('company',$user = $this->security->getUser())
                        ;
                },
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }


}
