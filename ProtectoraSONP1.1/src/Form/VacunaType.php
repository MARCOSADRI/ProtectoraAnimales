<?php

namespace App\Form;

use App\Entity\Vacuna;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VacunaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombreV', TextType::class, array(
            'label' => 'Nombre de la vacuna: ',
            'attr' => array('class' => 'form-control'),
        ))
        ->add('previene', TextType::class, array(
            'label' => 'Enfermedad prevenida: ',
            'attr' => array('class' => 'form-control'),
        ))
        ->add('fabricante', TextType::class, array(
            'label' => 'Fabricante: ',
            'attr' => array('class' => 'form-control'),
        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vacuna::class,
        ]);
    }
}