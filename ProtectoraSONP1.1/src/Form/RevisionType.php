<?php

namespace App\Form;

use App\Entity\Enfermedad;
use App\Entity\Revision;
use App\Entity\Vacuna;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RevisionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enfermedad', EntityType::class, array(
                'label' => 'Motivo de revisión: ',
                'class' => Enfermedad::class,
                'attr' => array('class' => 'form-control'),
                'choice_label' => 'nombreE'
            ))
            ->add('vacuna', EntityType::class, array(
                'label' => 'Vacuna suministrada: ',
                'class' => Vacuna::class,
                'attr' => array('class' => 'form-control'),
                'choice_label' => 'nombreV'
            ))
            ->add('fecha', DateType::class, array(
                'label' => 'Fecha de revisión: ',
                'attr' => array('class' => 'form-control', 'id' => 'fecha'),
            ))
            ->add('diagnostico', TextareaType::class, array(
                'label' => 'Diagnóstico de la revisión: ',
                'attr' => array('class' => 'form-control', 'id' => 'diagnostico'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Revision::class,
        ]);
    }
}