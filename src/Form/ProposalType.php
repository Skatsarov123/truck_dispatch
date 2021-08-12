<?php

namespace App\Form;

use App\Entity\Proposal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProposalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proposalPrice',MoneyType::class,['label'=>'Цена'])
            ->add('proposalLoadingDate',DateTimeType::class,['label' => 'Дата на товарене', 'data' => new \DateTime("now")])
            ->add('proposalUnloadingDate',DateTimeType::class,['label' => 'Дата на разтоварене', 'data' => new \DateTime("now")])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proposal::class,
        ]);
    }
}
