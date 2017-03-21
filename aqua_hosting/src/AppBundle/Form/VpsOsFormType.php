<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VpsOsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('server_id', ChoiceType::class, [
                'placeholder' => 'Choose a Server Location',
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                ]
            ])
            ->add('platform_id', ChoiceType::class, [
                'placeholder' => 'Choose a Operating System Type',
                'choices' => [
                    'Linux' => 1,
                    'Windows' => 2,
                ]
            ])
            ->add('sort_order')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

            'data_class' => 'AppBundle\Entity\VpsOs',
        ]);
    }

    public function getName()
    {
        return 'app_bundle_vps_os_form_type';
    }
}
