<?php
/**
 * Created by PhpStorm.
 * User: CR
 * Date: 12/28/2016
 * Time: 19:43
 */

namespace AppBundle\Form;


use AppBundle\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailsType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('ingredients', CollectionType::class, array(
                'label' => 'Съставки:',
                'entry_type' => IngredientType::class,
                'allow_add' => true,
                'by_reference' => false))

            ->add('title', TextType::class, array(
                'label' => 'Заглавие:',
                'attr' => ['class' => 'form-control']))

            ->add('preparation', TextareaType::class, array(
                'label' => 'Приготвяне:',
                'attr' => ['class' => 'form-control']))

            ->add('image', FileType::class, array(
                'label' => 'Избери снимка:'))

            ->add('comments', TextareaType::class, array(
                'label' => 'Post Comment:'
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver){

        $resolver->setDefaults(array(
            'data_class' => Recipe::class,
        ));
    }

}