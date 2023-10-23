<?php

namespace App\Services\Admin;

use App\Imports\TableImport;
use App\Jobs\ImportCsvTableJob;
use App\Models\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class TableService extends AbstractService
{
    public function getTables()
    {
        $tables = Table::with('shop_id')
            ->where('shop_id', $this->user()->shop_id)
            ->paginate(config(config('const.paginate')));

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
            $fileName = now()->format('dmY_His').'_'.Str::random().'.'.$file->extension();
            $filePath = Table::TABLE_FOLDER . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            dispatch(new ImportCsvTableJob($filePath));
            \Log::debug('Import Table CSV [DONE]');
            return true;
        } catch (\Exception $e) {
            \Log::debug('Import Table CSV [ERROR]');
            \Log::debug($e->getMessage());
            return false;
        }

    }
}
