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
        return array_filter($this->fieldMapping);
    }

    /**
     * returns the index of the house-number field, if it is enabled
     */
    public function getHouseNumberFieldIndex(): ?int
    {
        preg_match('/^street\.(\d+)$/', $this->get()['street_number'] ?? '', $matches);
        $houseNumberFieldIndex = $matches[1] ?? null;
        if (is_numeric($houseNumberFieldIndex)) {
            return (int) $houseNumberFieldIndex;
        }

        return null;
    }
}
