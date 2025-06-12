<?php

namespace App\Form;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TinyMCEType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // Ajoute la classe CSS qui active TinyMCE
        $view->vars['attr']['class'] = 'ea-tinymce';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => ['rows' => 20],
        ]);
    }

    public function getParent()
    {
        return TextareaType::class;
    }
}
