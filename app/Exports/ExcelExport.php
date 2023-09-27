<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View; //追加
use Maatwebsite\Excel\Concerns\FromView; //追加

class ExcelExport implements FromView //書き換え
{
    protected $counts; //追加 変数名は適宜変更
    protected $headings; //追加 変数名は適宜変更

    function __construct($counts, $headings)
    {
        $this->counts = $counts;
        $this->headings = $headings;
    }

    public function collection()
    {
        // return ExcelDatas::all()->makeHidden(['id', 'created_at', 'updated_at']);
    }

    public function view(): View //書き換え
    {
        return view('visitors.excel', [
            'counts' => $this->counts,
            'headings' => $this->headings,
        ]);
    }
}
