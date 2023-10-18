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
     */
    public function afterIsRequired(StreetAttributeField $subject, bool $result): bool
    {
        return $subject->getConfig()->getRequired();
    }
}
