<?php

namespace App\Services\Admin;

use App\Imports\TableImport;
use App\Jobs\ImportCsvTableJob;
use App\Models\Table;
use Maatwebsite\Excel\Facades\Excel;

class TableService extends AbstractService
{
    public function getTables()
    {
        $tables = Table::with('shop')
            ->where('shop_id', $this->user()->shop_id)
            ->paginate(config('const.paginate'));

        return $tables;
    }

    public function createTable($data)
    {
        $data['shop_id'] = $this->user()->shop_id;
        $table = Table::create($data);

        return $table;
    }

    public function updateTable($table, $data)
    {
        return $table->update($data);
    }

    public function importTable($file)
    {
        try {
            \Log::debug('Import Table CSV [START]');
            Excel::import(new TableImport($this->user()->shop_id), $file);
            \Log::debug('Import Table CSV [DONE]');
            return true;
        } catch (\Exception $e) {
            \Log::debug('Import Table CSV [ERROR]');
            \Log::debug($e->getMessage());
            return false;
        }

    }
}
