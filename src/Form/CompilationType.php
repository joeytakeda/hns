<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\Compilation;

use Nines\MediaBundle\Form\LinkableType;
use Nines\MediaBundle\Form\Mapper\LinkableMapper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Compilation form.
 */
class CompilationType extends AbstractType {
    private LinkableMapper $mapper;

    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('name', TextType::class, [
            'label' => 'Name',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('label', TextType::class, [
            'label' => 'Label',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('description', TextareaType::class, [
            'label' => 'Description',
            'required' => false,
            'attr' => [
                'help_block' => '',
                'class' => 'tinymce',
            ],
        ]);
        LinkableType::add($builder, $options);
        $builder->setDataMapper($this->mapper);
    }

    /**
     * @param LinkableMapper $mapper
     * @required
     */
    public function setLinkableMapper(LinkableMapper $mapper) {
        $this->mapper = $mapper;
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     */
    public function configureOptions(OptionsResolver $resolver) : void {
        $resolver->setDefaults([
            'data_class' => Compilation::class,
        ]);
    }
}