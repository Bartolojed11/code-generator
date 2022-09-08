<?php
namespace App\Support;

use Illuminate\Support\Facades\DB;

Class InfoSchema {
    public static function getDatabases()
    {
        return DB::table('schemata')
            ->where('schema_name', '!=', 'information_schema')
            // ->whereIn('schema_name', ['e_commerce', 'blogs'])
            ->get('SCHEMA_NAME as databases');
    }

    public static function getTables($schema)
    {
        return DB::table('columns')->where('table_schema', $schema)->distinct()->get('table_name as tables')->pluck('tables');
    }

    public static function getTablePK($table, $schema)
    {
        return DB::table('columns')
            ->where('table_name', $table)
            ->where('table_schema', $schema)
            ->where('column_key', 'PRI')
            ->get('column_name')->pluck('column_name');
    }

    public static function getTableColumns($table, $schema)
    {
        return DB::table('columns')
            ->where('table_name', $table)
            ->where('table_schema', $schema)
            ->get('column_name')->pluck('column_name');
    }
}