<?php

namespace AppBundle\Form;

use AppBundle\Entity\VpsCpanel;
use AppBundle\Entity\VpsOs;
use AppBundle\Respository\VpsCpanelRespository;
use AppBundle\Respository\VpsOsRespository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VpsCpanelConnFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['attr']['id'];
        $builder
             ->add('Vpsos', EntityType::class, [
                 'class' => VpsOs::class,
                 'query_builder' => function (VpsOsRespository $er) use ($id) {
                     return $er->findbyid($id);
                 },
                 'choice_label' => 'name',
                 'label' => false,
                 'attr' => array(
                     'class' => 'hidden'
                 )
             ])
            ->add('Vpscpanel', EntityType::class, [
                'placeholder' => 'Choose a Cpanel',
                'class' => VpsCpanel::class,
                'query_builder' => function (VpsCpanelRespository $er) use ($id) {
                    return $er->findNoCpCpanelConnbyId($id);
                },
                'choice_label' => 'vps_cpanel_desc'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

            'data_class' => 'AppBundle\Entity\VpsCpanelConn',
        ]);
    }

    public function getName()
    {
        return 'app_bundle_vps_cpanel_conn_form_type';
    }
}
