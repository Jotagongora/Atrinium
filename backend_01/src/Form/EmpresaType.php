<?php

namespace App\Form;

use App\Entity\Empresa;
use App\Entity\Sector;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('Nombre', TextType::class, [
                'required' => true
            ])
            ->add('Telefono', TextType::class, [
                'required' => false
            ])
            ->add('Email', EmailType::class)
            ->add('Sector', EntityType::class, [
                'class' => Sector::class,
                'placeholder' => 'Selecciona sector',
                'required' => true,
                'choice_label' => function ($sector) {
                    return $sector->getNombre();
                }
            ])
            ->add('Guardar', SubmitType::class)
            ->add('Cancelar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
