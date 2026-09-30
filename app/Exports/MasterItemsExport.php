<?php

namespace App\Exports;

use App\Models\MasterItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MasterItemsExport implements
    FromCollection,
    WithHeadings,
    WithMapping
{
    public function collection()
    {
        return MasterItem::with('categories')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Kategori',
            'Nama Items',
            'Nama Supplier',
            'Harga',
            'Laba',
            'Harga Jual',
        ];
    }

    public function map($item): array
    {
        return [
            $item->id,

            $item->categories
                ->pluck('nama')
                ->implode(', '),

            $item->nama,

            $item->supplier,

            $item->harga_beli,

            $item->laba,

            $item->harga_beli + $item->laba,
        ];
    }
}