<?php

namespace App\Form;

use App\Entity\Pizza;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

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
