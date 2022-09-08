<?php

namespace App\Http\Controllers;

use App\Support\InfoSchema;
use Illuminate\Http\Request;

class CodeIgniterCGController extends Controller
{
    public function index()
    {
        $dbs = InfoSchema::getDatabases();

        return view('codeigniter.index', compact('dbs'));
    }

    public function getDBTables(Request $request)
    {
        $tables = InfoSchema::getTables($request->database);
        return response()->json($tables);
    }

    public function getDBS()
    {
        // $databases = InfoSchema::getDatabases()->pluck('databases');
        $databases = InfoSchema::getDatabases();
        return response()->json($databases);
    }

    public function getTableColumns(Request $request)
    {
        $columns = InfoSchema::getTableColumns($request->table, $request->database);
        $pk = InfoSchema::getTablePK($request->table, $request->database);
        return response()->json([
            'columns' => $columns,
            'pk' => $pk
        ]);
    }
}
