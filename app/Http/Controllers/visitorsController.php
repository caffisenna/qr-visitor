<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatevisitorsRequest;
use App\Http\Requests\UpdatevisitorsRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\visitorsRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\visitors;
use Illuminate\Support\Facades\DB;
use App\Exports\ExcelExport; // excel export用
use Maatwebsite\Excel\Facades\Excel; // excel export用

class visitorsController extends AppBaseController
{
    /** @var visitorsRepository $visitorsRepository*/
    private $visitorsRepository;

    public function __construct(visitorsRepository $visitorsRepo)
    {
        $this->visitorsRepository = $visitorsRepo;
    }

    /**
     * Display a listing of the visitors.
     */
    public function index(Request $request)
    {
        if (isset($request->booth_id)) {
            $visitor = new Visitors;
            $visitor->booth_number = $request->booth_id;
            $visitor->created_at = now();
            $visitor->updated_at = now();
            $visitor->save();
        }
        $visitors = $this->visitorsRepository->paginate(100);

        return view('visitors.index')
            ->with('visitors', $visitors);
    }

    /**
     * Show the form for creating a new visitors.
     */
    public function create()
    {
        return view('visitors.create');
    }

    /**
     * Store a newly created visitors in storage.
     */
    public function store(CreatevisitorsRequest $request)
    {
        $input = $request->all();

        $visitors = $this->visitorsRepository->create($input);

        Flash::success('通過処理が完了しました。');

        // return redirect(route('visitors.index'));
        return redirect('home');
    }

    /**
     * Display the specified visitors.
     */
    public function show($id)
    {
        $visitors = $this->visitorsRepository->find($id);

        if (empty($visitors)) {
            Flash::error('Visitors not found');

            return redirect(route('visitors.index'));
        }

        return view('visitors.show')->with('visitors', $visitors);
    }

    /**
     * Show the form for editing the specified visitors.
     */
    public function edit($id)
    {
        $visitors = $this->visitorsRepository->find($id);

        if (empty($visitors)) {
            Flash::error('Visitors not found');

            return redirect(route('visitors.index'));
        }

        return view('visitors.edit')->with('visitors', $visitors);
    }

    /**
     * Update the specified visitors in storage.
     */
    public function update($id, UpdatevisitorsRequest $request)
    {
        $visitors = $this->visitorsRepository->find($id);

        if (empty($visitors)) {
            Flash::error('Visitors not found');

            return redirect(route('visitors.index'));
        }

        $visitors = $this->visitorsRepository->update($request->all(), $id);

        Flash::success('Visitors updated successfully.');

        return redirect(route('visitors.index'));
    }

    /**
     * Remove the specified visitors from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $visitors = $this->visitorsRepository->find($id);

        if (empty($visitors)) {
            Flash::error('Visitors not found');

            return redirect(route('visitors.index'));
        }

        $this->visitorsRepository->delete($id);

        Flash::success('Visitors deleted successfully.');

        return redirect(route('visitors.index'));
    }

    public function sum()
    {
        $startDate = '2023-10-13'; // 開始日
        $endDate = '2023-10-14';   // 終了日

        $counts = DB::table('visitors')
            ->select(
                'booth_number',
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') AS date"),
                DB::raw("CASE
                WHEN TIME(created_at) BETWEEN '09:00:00' AND '09:59:59' THEN '09:00'
                WHEN TIME(created_at) BETWEEN '10:00:00' AND '10:59:59' THEN '10:00'
                WHEN TIME(created_at) BETWEEN '11:00:00' AND '11:59:59' THEN '11:00'
                WHEN TIME(created_at) BETWEEN '12:00:00' AND '12:59:59' THEN '12:00'
                WHEN TIME(created_at) BETWEEN '13:00:00' AND '13:59:59' THEN '13:00'
                WHEN TIME(created_at) BETWEEN '14:00:00' AND '14:59:59' THEN '14:00'
                WHEN TIME(created_at) BETWEEN '15:00:00' AND '15:59:59' THEN '15:00'
                ELSE '16:00' END AS time_interval"),
                DB::raw('SUM(1) AS count')
            )
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('booth_number', 'date', 'time_interval') // 'date'も含める
            ->orderBy('booth_number')
            ->orderBy('time_interval')
            ->get();

        // dd($counts);

        return view('visitors.sum')->with('counts', $counts);
    }

    public function export_to_excel()
    {
        $filename = 'export.xlsx';

        $startDate = '2023-10-13'; // 開始日
        $endDate = '2023-10-14';   // 終了日

        $counts = DB::table('visitors')
            ->select(
                'booth_number',
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') AS date"),
                DB::raw("CASE
                WHEN TIME(created_at) BETWEEN '09:00:00' AND '09:59:59' THEN '09:00'
                WHEN TIME(created_at) BETWEEN '10:00:00' AND '10:59:59' THEN '10:00'
                WHEN TIME(created_at) BETWEEN '11:00:00' AND '11:59:59' THEN '11:00'
                WHEN TIME(created_at) BETWEEN '12:00:00' AND '12:59:59' THEN '12:00'
                WHEN TIME(created_at) BETWEEN '13:00:00' AND '13:59:59' THEN '13:00'
                WHEN TIME(created_at) BETWEEN '14:00:00' AND '14:59:59' THEN '14:00'
                WHEN TIME(created_at) BETWEEN '15:00:00' AND '15:59:59' THEN '15:00'
                ELSE '16:00' END AS time_interval"),
                DB::raw('SUM(1) AS count')
            )
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('booth_number', 'date', 'time_interval') // 'date'も含める
            ->orderBy('booth_number')
            ->orderBy('time_interval')
            ->get();

        //エクセルの見出しを以下で設定
        $headings = [
        ];

        //以下で先ほど作成したExcelExportにデータを渡す。
        return Excel::download(new ExcelExport($counts, $headings), $filename);
    }
}
