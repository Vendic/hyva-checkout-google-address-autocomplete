<?php declare(strict_types=1);
/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */

namespace Vendic\HyvaCheckoutGoogleAddressAutocomplete\Model\Form\Modifier;

use Hyva\Checkout\Model\Form\EntityFormInterface;
use Hyva\Checkout\Model\Form\EntityFormModifierInterface;

class AddHousenumberFieldValidation implements EntityFormModifierInterface
{
    public function apply(EntityFormInterface $form): EntityFormInterface
    {
        $form->registerModificationListener(
            'addValidationToHousenumber',
            'form:build',
            function (EntityFormInterface $form) {
                $street = $form->getElement('street');

                $relatives = $street->getRelatives();

                // Check if there is only one relative, if not, we don't have a housenumber field
                // and there is a different setup for the street field.
                if (count($relatives) !== 1) {
                    return;
                }

                $housenumberField = reset($relatives);

                if (!$housenumberField) {
                    return;
                }

                $housenumberField->setValidationRule('validate-housenumber', true);
            }
        );

        return $form;
    }
}
