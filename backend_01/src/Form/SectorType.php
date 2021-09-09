<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Sector;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SectorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre')
            ->add('Guardar', SubmitType::class)
            ->add('Cancelar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sector::class,
        ]);
    }
}
