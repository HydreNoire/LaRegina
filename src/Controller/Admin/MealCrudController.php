<?php

namespace App\Controller\Admin;

use App\Entity\Meal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MealCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Meal::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $pictureDir = $this->getParameter('image_directory');
        $uploadDir = $this->getParameter('upload_directory');
        return [
            FormField::addPanel('Appetizer info')
                ->setColumns(6)
                ->setIcon('fas fa-info')
                ->collapsible(),
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextareaField::new('description'),

            FormField::addPanel('Price & Image')
                ->setIcon('fas fa-barcode'),
            NumberField::new('price')
                ->setColumns(3),
            ImageField::new('picture')
                ->setColumns(9)
                ->setBasePath($uploadDir)
                ->setUploadDir($pictureDir)
                ->setUploadedFileNamePattern('[uuid]-laregina.[extension]')
                ->setCssClass('menu-img')
        ];
    }
    
}
