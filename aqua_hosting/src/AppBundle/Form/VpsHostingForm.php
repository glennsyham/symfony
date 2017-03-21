<?php

namespace AppBundle\Form;

use AppBundle\Entity\Members;
use AppBundle\Entity\RemoteBackup;
use AppBundle\Entity\VpsCpanel;
use AppBundle\Entity\VpsDatabase;
use AppBundle\Entity\VpsOs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VpsHostingForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ip_address = array();
        foreach (range(1, 24) as $number) {
            $ip_address[$number] = $number.' Ip Addresses';
        }
        $builder
            ->add('vpsos', EntityType::class, [
                'placeholder' => 'Select an operating system',
                'class' => VpsOs::class,
                'choice_label' => 'name',
                'label' => false
            ])
            ->add('cpu', HiddenType::class, [
                'data' => 1,
            ])
            ->add('ram', HiddenType::class, [
                'data' => 1,
            ])
            ->add('hd', HiddenType::class, [
                'data' => 1,
            ])
            ->add('ip_addresses', ChoiceType::class, [
                'choices' => array_flip($ip_address),
                'label' => false
            ])
            ->add('vpscpanel', EntityType::class, [
                'placeholder' => 'No Control Panel',
                'class' => VpsCpanel::class,
                'choice_label' => 'vps_cpanel_desc',
                'label' => false
            ])
            ->add('vpsdatabase', EntityType::class, [
                'placeholder' => 'No Database',
                'class' => VpsDatabase::class,
                'choice_label' => 'desc',
                'label' => false
            ])
            ->add('remotebackup', EntityType::class, [
                'placeholder' => 'No Remote Backup',
                'class' => RemoteBackup::class,
                'choice_label' => 'description',
                'label' => false
            ])
            ->add('host_name', HiddenType::class, [
                'trim' => true
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

            'data_class' => 'AppBundle\Entity\VpsHosting',
            'attr' => ['id' => 'configure']
        ]);
    }

    public function getName()
    {
        return 'app_bundle_vps_hosting_form';
    }
}
