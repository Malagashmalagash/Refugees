<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType
{
    /**
     * @param string $label
     * @param string $placeholder
     * @param array $options
     *
     * function protected : inheritance from mother to child is possible
     *
     * @return array
     */

    protected function getConfiguration($label, $placeholder,$options = [])
    {
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }
}