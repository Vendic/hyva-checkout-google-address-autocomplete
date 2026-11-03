<?php

/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */

declare(strict_types=1);

namespace Vendic\HyvaCheckoutGoogleAddressAutocomplete\Plugin;

use Hyva\Checkout\Magewire\Checkout\AddressView\BillingDetails;
use Magento\Quote\Model\Quote;

class BillingAsShippingTogglePlugin
{
    /**
     * We need to re-init the autocomplete JS when the billing address is not identical to the shipping address.
     * To do this, we dispatch an event to the frontend, which will re-init the autocomplete JS.
     * Magewire 3 spreads the event data into named arguments, so it has to be an array.
     */
    public function afterToggleBillingAsShipping(BillingDetails $subject, Quote $result): Quote
    {
        $subject->dispatchBrowserEvent('billing-as-shipping-toggled', []);

        return $result;
    }
}
