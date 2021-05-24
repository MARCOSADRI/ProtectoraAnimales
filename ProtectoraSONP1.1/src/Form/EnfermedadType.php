<?php

namespace App\Form;

use App\Entity\Enfermedad;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnfermedadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreE', TextType::class, array(
                'label' => 'Introducir nombre de la enfermedad',
                'attr' => array('class' => 'form-control'),
                'data_class' => null,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enfermedad::class,
        ]);
    }
}