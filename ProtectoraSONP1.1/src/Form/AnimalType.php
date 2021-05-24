<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Raza;
use App\Entity\Especie;
use App\Entity\Tamano;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreA', TextType::class, array(
                'label' => 'Introducir nombre: ',
                'attr' => array('class' => 'form-control'),
            ))
            ->add('sexo', ChoiceType::class, array(
                'label' => 'Introducir sexo: ',
                'attr' => array('class' => 'form-control'),
                'choices' => array(
                    
                    'Macho' => 'M',
                    'Hembra' => 'H'
                )
            ))
            ->add('foto', FileType::class, array(
                'label' => 'FOTO: ',
                'attr' => array('class' => 'form-control'),
                'data_class' => null
            ))
            ->add('edad', TextType::class, array(
                'label' => 'Introducir edad: ',
                'attr' => array('class' => 'form-control'),
            ))
            ->add('tamano', EntityType::class, array(
                'label' => 'Introducir tamaño: ',
                'attr' => array('class' => 'form-control'),
                'placeholder' => 'Selecciona un tamaño',
                'class' => Tamano::class,
                'choice_label' => 'title'
            ))
            ->add('raza', EntityType::class, array(
                'label' => 'Introducir raza: ',
                'attr' => array('class' => 'form-control'),
                'placeholder' => 'Selecciona una raza',
                'class' => Raza::class,
                'choice_label' => 'title'
            ))
            ->add('especie', EntityType::class, array(
                'label' => 'Introducir especie: ',
                'attr' => array('class' => 'form-control'),
                'placeholder' => 'Selecciona una especie',
                'class' => Especie::class,
                'choice_label' => 'title'
            ))
            /* ->add('tipo') */
            /* ->add('usuario') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
