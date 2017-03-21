<?php

namespace AppBundle\Form;

use AppBundle\Entity\MembersDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Intl\Intl as Intl;

class MembersDetailEmbeddedForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countries  = array_flip(Intl::getRegionBundle()->getCountryNames());

        $builder
            ->add('first_name', TextType::class)
            ->add('last_name', TextType::class)
            ->add('org_name', TextType::class)
            ->add('phone', TextType::class)
            ->add('address1', TextType::class)
            ->add('address2', TextType::class)
            ->add('city', TextType::class)
            ->add('country', ChoiceType::class, [
                'choices' => $countries,
                'preferred_choices' => array('US'),

            ])
            ->add('state', TextType::class)
            ->add('postal_code', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MembersDetail::class
        ]);
    }
}
