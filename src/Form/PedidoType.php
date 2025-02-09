<?php

namespace App\Form;

use App\Entity\Cliente;
use App\Entity\Estado;
use App\Entity\Pedido;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', null, [
                'widget' => 'single_text',
            ])
            ->add('total')
            ->add('cliente', EntityType::class, [
                'class' => Cliente::class,
                'choice_label' => 'id',
            ])
            ->add('estado', EntityType::class, [
                'class' => Estado::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pedido::class,
        ]);
    }
}
