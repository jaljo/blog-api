<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Asserts;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new Asserts\NotBlank(),
                    new Asserts\NotNull(),
                    new Asserts\Length(['max' => 100]),
                ],
            ])
            ->add('content', TextareaType::class, [
                'constraints' => [
                    new Asserts\NotBlank(),
                    new Asserts\NotNull(),
                ],
            ])
        ;
    }
}
