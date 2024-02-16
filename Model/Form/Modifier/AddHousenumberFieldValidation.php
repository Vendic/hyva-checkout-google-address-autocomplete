<?php declare(strict_types=1);
/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */

namespace Vendic\HyvaCheckoutGoogleAddressAutocomplete\Model\Form\Modifier;

use Hyva\Checkout\Model\Form\EntityFormElementInterface;
use Hyva\Checkout\Model\Form\EntityFormInterface;
use Hyva\Checkout\Model\Form\EntityFormModifierInterface;

class AddHousenumberFieldValidation implements EntityFormModifierInterface
{
    /**
     * Add validation to the housenumber field if street has only one relative, which should mean that there are two
     * street fields.
     *
     * This form modifier is included in the module to make sure that the address the autocomplete API returns contains
     * an housenumber, since it's possible that the API returns an address without a housenumber.
     * If the housenumber is not present, the address is not valid and the customer cannot continue.
     */
    public function apply(EntityFormInterface $form): EntityFormInterface
    {
        $form->registerModificationListener(
            'addValidationToHousenumber',
            'form:build',
            function (EntityFormInterface $form) {
                $street = $form->getElement('street');

                if (!$street instanceof EntityFormElementInterface) {
                    return;
                }

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
