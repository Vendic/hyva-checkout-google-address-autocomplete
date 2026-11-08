<?php

/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */

declare(strict_types=1);

namespace Vendic\HyvaCheckoutGoogleAddressAutocomplete\Model\Form\Modifier;

use Hyva\Checkout\Model\Form\AbstractEntityForm;
use Hyva\Checkout\Model\Form\AbstractEntityFormModifier;
use Hyva\Checkout\Model\Form\EntityFieldInterface;
use Hyva\Checkout\Model\Form\EntityFormElementInterface;
use Vendic\HyvaCheckoutGoogleAddressAutocomplete\ViewModel\FieldMapping;

class AddHousenumberFieldValidation extends AbstractEntityFormModifier
{
    public function __construct(
        private readonly FieldMapping $fieldMapping
    ) {
    }

    /**
     * Add validation to the housenumber field if street has only one relative, which should mean that there are two
     * street fields, and the field mapping uses that relative as the housenumber field (street_number).
     *
     * This form modifier is included in the module to make sure that the address the autocomplete API returns contains
     * an housenumber, since it's possible that the API returns an address without a housenumber.
     * If the housenumber is not present, the address is not valid and the customer cannot continue.
     */
    public function apply(AbstractEntityForm $form): AbstractEntityForm
    {
        $houseNumberFieldIndex = $this->fieldMapping->getHouseNumberFieldIndex();
        if ($houseNumberFieldIndex === null) {
            return $form;
        }

        $form->registerModificationListener(
            'addValidationToHousenumber',
            'form:build',
            function (AbstractEntityForm $form) use ($houseNumberFieldIndex) {
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

                $housenumberField = $relatives[$houseNumberFieldIndex] ?? null;

                if (!$housenumberField instanceof EntityFieldInterface) {
                    return;
                }

                $housenumberField->setValidationRule('validate-housenumber', true);
            }
        );

        return $form;
    }
}
