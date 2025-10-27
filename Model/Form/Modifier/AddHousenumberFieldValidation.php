<?php declare(strict_types=1);
/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */

namespace Vendic\HyvaCheckoutGoogleAddressAutocomplete\Model\Form\Modifier;

use Hyva\Checkout\Model\Form\EntityFormElementInterface;
use Hyva\Checkout\Model\Form\EntityFormInterface;
use Hyva\Checkout\Model\Form\EntityFormModifierInterface;
use Vendic\HyvaCheckoutGoogleAddressAutocomplete\ViewModel\FieldMapping;

class AddHousenumberFieldValidation implements EntityFormModifierInterface
{

    public function __construct(
        private readonly FieldMapping $fieldMapping
    )
    {
    }

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
        $houseNumberFieldIndex = $this->fieldMapping->getHouseNumberFieldIndex();
        if ($houseNumberFieldIndex === null) {
            return $form;
        }

        $form->registerModificationListener(
            'addValidationToHousenumber',
            'form:build',
            function (EntityFormInterface $form) use ($houseNumberFieldIndex) {
                $street = $form->getElement('street');

                if (!$street instanceof EntityFormElementInterface) {
                    return;
                }

                $housenumberField = $street->getRelatives()[$houseNumberFieldIndex] ?? null;

                if (!$housenumberField) {
                    return;
                }

                $housenumberField->setValidationRule('validate-housenumber', true);
            }
        );

        return $form;
    }
}
