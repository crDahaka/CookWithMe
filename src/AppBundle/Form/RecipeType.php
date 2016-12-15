<?php
/**
 * Created by PhpStorm.
 * User: CR
 * Date: 12/14/2016
 * Time: 14:47
 */

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RecipeType
 * @package AppBundle\Form
 */
class RecipeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('preparation', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('image', FileType::class, array('label' => 'Upload Image'))
            ->add('save', SubmitType::class, array('label' => 'Create Recipe', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Recipe',
        ));
    }

}