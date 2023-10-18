<?php declare(strict_types=1);
/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */

namespace Vendic\HyvaCheckoutGoogleAddressAutocomplete\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class AutoCompleteSelectors implements ArgumentInterface
{
    public function __construct(private readonly array $selectors)
    {
    }

    /**
     * To add more fields to the autocomplete, add them to the selectors array via DI injection.
     */
    public function get() : array
    {
        return array_values($this->selectors);
    }
}
