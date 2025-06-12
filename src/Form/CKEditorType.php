<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CKEditorType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // Ajoute la classe CSS qui active CKEditor
        $view->vars['attr']['class'] = 'ea-ckeditor';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // Définit une hauteur par défaut pour le textarea
        $resolver->setDefaults([
            'attr' => ['rows' => 100],
        ]);
    }

    // Hérite de TextareaType (un simple textarea)
    public function getParent()
    {
        return TextareaType::class;
    }
}