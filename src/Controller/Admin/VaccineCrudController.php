<?php

namespace App\Controller\Admin;

use App\Entity\Vaccine;
use App\Form\TinyMCEType;
use App\Form\VaccineImageType;
use Ehyiah\QuillJsBundle\DTO\QuillGroup;
use Ehyiah\QuillJsBundle\Form\QuillAdminField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VaccineCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vaccine::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
            return $action->setLabel('Ajouter un nouvel vaccin');
        });
        // ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
        //     return $action->setLabel('Modifier le vaccin');
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
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des vaccins')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un nouveau vaccin')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un vaccin')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du vaccin');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextareaField::new('name')
            ->setLabel('Nom')
            ->setFormType(TinyMCEType::class)
            ->formatValue(function ($value, $entity) {
                return $entity->getCleanName() ?? $value;
            }),

            
            ChoiceField::new('game')
            ->setLabel('Game')
            ->setChoices([
                'Aviaire' => 'Aviaire',
                'Rimunant' => 'Rimunant',
                'Porcine' => 'Porcine',
                'Canine' => 'Canine',
            ]),

            CollectionField::new('vaccineImages')
                ->setLabel('Image')
                ->setEntryType(VaccineImageType::class),

            AssociationField::new('vaccineDetails')->setCrudController(VaccineDetailsCrudController::class)
            ->setLabel('Details')
            ->hideOnForm(),
            ];
    }

}
