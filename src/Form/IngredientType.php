<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\core\Type\ImagesType;
use Symfony\Component\Form\Extension\core\Type\NumberType;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name') 
            ->add('image' , ImageType::class) 
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Liquide' => 'liquide',
                    'Solide' => 'solide',
                    'Piece' => 'piece',
                ),
                )
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
