<?php

namespace LSB\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class WarhammerBattleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('players', IntegerType::class)
            ->add('style', ChoiceType::class, array('choices'  => array(
                'Jeu amical' => 'Jeu amical',
                'Entrainement tournoi' => 'Entrainement tournoi')))
            ->add('mode', ChoiceType::class, array('choices'  => array(
                '8th âge' => '8th',
                '9th âge' => '9th',
                'AOS' => 'aos',
                'KOW' => 'kow')))
            ->add('armyPoints', IntegerType::class)
            ->add('Valider', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LSB\AppBundle\Entity\WarhammerBattle'
        ));
    }
}
