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
     * Add validation to the street line that the field mapping uses as the housenumber field (street_number).
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

                $housenumberField = $street->getRelatives()[$houseNumberFieldIndex] ?? null;

                if (!$housenumberField instanceof EntityFieldInterface) {
                    return;
                }

                $housenumberField->setValidationRule('validate-housenumber', true);
            }
        );

        return $form;
    }
}
