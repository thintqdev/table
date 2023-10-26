<?php

namespace App\Imports;

use App\Models\Table;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TableImport implements ToModel, WithStartRow, WithChunkReading, ShouldQueue
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function startRow(): int
    {
            return 2;
    }

    public function chunkSize(): int
    {
        return 10;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Table([
            'name' => $row[0],
            'location' => $row[1],
            'shop_id' => $this->shopId,
        ]);
    }
}
