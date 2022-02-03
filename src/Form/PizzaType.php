<?php

namespace App\Form;

use App\Entity\Pizza;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                // Personalise le label
                'label' => 'Nom de la pizza :',
                // Définie si le champ est requis ou non
                // par défault c'est "true"
                'required' => false,
                // Définie les attributs HTML de notre widget
                'attr' => [
                    // Ajoute un placeholder à l'input
                    'placeholder' => 'Régina, Vegan, Etc ...',
                    // Ajoute une class 'my-input'
                    'class' => 'my-input',
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la pizza :',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix de la pizza :',
            ])
            ->add('image', UrlType::class, [
                'label' => 'Url de l\'image de la pizza :',
                'required' => false,
            ])
            ->add('ingredients', EntityType::class, [
                // Détermine l'entité à lier à notre pizza
                'class' => Ingredient::class,
                // Choix de la propriété qui s'affichera dans notre formulaire
                'choice_label' => 'name',
                // Permet de définir si ou peu séléctioner plusieurs entités
                'multiple' => true,
                // Permet de déterminer si l'on veut des radio/checkbox ou
                // un select (true === checkbox, false === select)
                'expanded' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer la pizza',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
            'method' => 'POST',
        ]);
    }
}
