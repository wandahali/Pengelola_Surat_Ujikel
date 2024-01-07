<?php

namespace App\Exports;

use App\Models\letter_type;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;

class ExportLetter implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return letter_type::query();
    }

    public function headings(): array
    {
        return [
            "Kode Surat",
            "Klasifikasi Surat",
            "Surat Tertaut"
        ];
    }

    public function map($item): array
    {
        return[
            $item->letter_code,
            $item->name_type,
            $item->letterType,
        ];
    }

}