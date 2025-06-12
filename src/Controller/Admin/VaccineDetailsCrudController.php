<?php

namespace App\Controller\Admin;

use App\Entity\VaccineDetails;
use App\Form\TinyMCEType;
use Ehyiah\QuillJsBundle\DTO\QuillGroup;
use Ehyiah\QuillJsBundle\Form\QuillAdminField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VaccineDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VaccineDetails::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
            return $action->setLabel('Ajouter un nouvel détail de vaccin');
        });
        // ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
        //     return $action->setLabel('Modifier unle vaccin');
        // })
        // ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
        //     return $action->setLabel('Supprimer le vaccin');
        // })
        // ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
        //     return $action->setLabel('Mettre à jour et continuer');
        // })
        // ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
        //     return $action->setLabel('Mettre à jour et revenir');
        // });
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des détailles des vaccins')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un nouveau détail vaccin')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un détail de vaccin')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du vaccin');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('vaccine')
    ->setLabel('Vaccin')
    ,

            TextareaField::new('autorisation')  // <- Utilisez TextareaField au lieu de TextField
            ->setLabel('Autorisation')
            ->setFormType(TinyMCEType::class)
            ->hideOnIndex(), // Optionnel: cache sur la liste,

            // QuillAdminField::new('presentation')
            // ->setLabel('Presentation')
            // ->setFormTypeOptions([
            // 'quill_options' => QuillGroup::buildWithAllFields(),
            //     'quill_extra_options' => [
            //         'placeholder' => '' // Masquer le placeholder
            //     ]
            // ]),

            TextareaField::new('presentation')  // <- Utilisez TextareaField au lieu de TextField
            ->setLabel('Presentation')
            ->setFormType(TinyMCEType::class),


            QuillAdminField::new('farmaceticalForm')
            ->setLabel('Forme pharmacetique')
            ->setFormType(TinyMCEType::class),
            
            QuillAdminField::new('compositionDose')
            ->setLabel('Composition par dose')
            ->setFormType(TinyMCEType::class),
            
            QuillAdminField::new('inicationContre')
            ->setLabel('Contre indication')
            ->setFormType(TinyMCEType::class),

            QuillAdminField::new('secondEffect')
            ->setLabel('Effect secondaire')
            ->setFormType(TinyMCEType::class),
            
            QuillAdminField::new('manual')
            ->setLabel('Manuel')
            ->setFormType(TinyMCEType::class),
            
            QuillAdminField::new('indication')
            ->setLabel('Indication')
            ->setFormType(TinyMCEType::class),

            QuillAdminField::new('precationUse')
            ->setLabel('Precaution d\'emploie')
            ->setFormType(TinyMCEType::class),
            
            QuillAdminField::new('concervation')
            ->setLabel('Concervation')
            ->setFormType(TinyMCEType::class),
            
            QuillAdminField::new('waitTime')
            ->setLabel('Delais d\'attente')
            ->setFormType(TinyMCEType::class),
            
            QuillAdminField::new('rappel')
            ->setLabel('Rappel')
            ->setFormType(TinyMCEType::class),

        ];
    }
        
}
