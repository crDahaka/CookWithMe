<?php
/**
 * Created by PhpStorm.
 * User: CR
 * Date: 12/14/2016
 * Time: 14:47
 */

namespace AppBundle\Form;

use AppBundle\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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

            ->add('category', EntityType::class, array(
                'attr' => ['class' => 'form-control'],
                'label' => 'Категория:',
                'class' => 'AppBundle\Entity\Category', 'choice_label' => 'name'))

            ->add('image', FileType::class, array(
                'label' => 'Избери снимка:', 'data_class' => null, 'required' => false));
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