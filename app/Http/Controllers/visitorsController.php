<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatevisitorsRequest;
use App\Http\Requests\UpdatevisitorsRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\visitorsRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\visitors;

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

        Flash::success('Visitors saved successfully.');

        return redirect(route('visitors.index'));
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
        // 通過人数をカウントする
        $counts = Visitors::select('booth_number')->selectRaw('count(id) as count_booth_number')->groupBy('booth_number')->orderBy('booth_number', 'asc')->get();

        return view('visitors.sum')->with('counts', $counts);
    }
}
