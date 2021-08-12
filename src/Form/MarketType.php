<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\TrailerType;
use App\Entity\CargoType;
use App\Entity\Market;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('loadingDate', DateTimeType::class, ['label' => 'Дата на товарене', 'data' => new \DateTime("now")])
            ->add('loadingZip', TextType::class, ['label' => 'Код'])
            ->add('loadingCountry', CountryType::class, ['label' => 'Държава'])
            ->add('loadingTown', TextType::class, ['label' => 'Град'])
            ->add('loadingStreet', TextType::class, ['label' => 'Улица'])
            ->add('unloadingZip', TextType::class, ['label' => 'Код'])
            ->add('unloadingCounty', CountryType::class, ['label' => 'Държава'])
            ->add('unloadingTown', TextType::class, ['label' => 'Град'])
            ->add('unloadingStreet', TextType::class, ['label' => 'Улица'])
            ->add('distance', NumberType::class, ['label' => 'Разстояние'])
            ->add('cargoWeight', IntegerType::class, ['label' => 'Тегло'])
            ->add('cargoHeight', IntegerType::class, ['label' => 'Височина'])
            ->add('cargoLength', IntegerType::class, ['label' => 'Дължина'])
            ->add('cargoType', EntityType::class, [
                'class' => CargoType::class,
                'label' => 'Вид товар',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('trailerType', EntityType::class, [
                'class' => TrailerType::class,
                'label' => 'Вид ремърке',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'translation_domain' => 'common',
                'label_attr' => ['class' => 'cursor_text'],
                'attr' => [
                    'style' => 'some style']
            ])
            ->add('price', MoneyType::class, ['label' => 'Цена']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Market::class
        ]);
    }
}
