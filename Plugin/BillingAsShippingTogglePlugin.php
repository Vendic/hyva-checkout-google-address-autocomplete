<?php
/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */
namespace Vendic\HyvaCheckoutGoogleAddressAutocomplete\Plugin;

use Hyva\Checkout\Magewire\Checkout\AddressView\BillingDetails;

class BillingAsShippingTogglePlugin
{
    /**
     * We need to re-init the autocomplete JS when the billing address is not identical to the shipping address.
     * To do this, we dispatch an event to the frontend, which will re-init the autocomplete JS.
     */
    public function afterToggleBillingAsShipping(BillingDetails $subject, $result)
    {
        $subject->dispatchBrowserEvent('billing-as-shipping-toggled', $result);

        return $result;
    }
}
