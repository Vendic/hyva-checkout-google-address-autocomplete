<?php
/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */

namespace Vendic\HyvaCheckoutGoogleAddressAutocomplete\Plugin;

use Hyva\Checkout\Model\Form\EntityField\EavEntityAddress\StreetAttributeField;
use Magento\Eav\Api\Data\AttributeInterface;

class RequiredHousenumberFieldPlugin
{
    /**
     * Get required from the config, bypass original logic that checks if there is an ancestor.
     *
     * A value set on the field itself wins: Hyvä Checkout 1.3.15 and newer set it per street line from
     * the "Street Fields" config and removed the per-line value from the field config, which now only
     * knows the required state of the street attribute as a whole.
     */
    public function afterIsRequired(StreetAttributeField $subject, bool $result): bool
    {
        $isRequired = $subject->getData(StreetAttributeField::IS_REQUIRED);

        return $isRequired === null ? $subject->getConfig()->getRequired() : (bool) $isRequired;
    }
}
