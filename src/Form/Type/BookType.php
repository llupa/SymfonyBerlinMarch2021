<?php

namespace App\Form\Type;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn', TextType::class)
            ->add('title', TextType::class)
            ->add('price', NumberType::class, ['scale' => 2])
            ->add('publisher', EntityType::class, ['class' => Publisher::class])
            ->add('authors', EntityType::class, ['class' => Author::class, 'multiple' => true]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Book::class);
    }
}
