<?php declare(strict_types=1);
/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */

namespace Vendic\HyvaCheckoutGoogleAddressAutocomplete\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class FieldMapping implements ArgumentInterface
{
    public function __construct(private readonly array $fieldMapping = [])
    {
    }

    public function get() : array
    {
        return $this->fieldMapping;
    }
}
