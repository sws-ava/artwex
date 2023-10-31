<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Repositories\Idea\IdeaRepository;
use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;

class IdeaController extends Controller
{
	private $model_name;

    private $idea;

    /**
     * construct
     */
    public function __construct(IdeaRepository $idea)
    {
        parent::__construct();
        $this->model_name = 'Идеи';
        $this->idea = $idea;
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ideas = Idea::orderBy('created_at', 'desc')->get();

        return view('admin.idea.index', [
            'ideas' => $ideas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$languages = Language::active()->get();
        return view('admin.idea.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateIdeaRequest $request)
    {
        $idea = $this->idea->store($request);	

        return redirect()->back()->withSuccess('Идея была успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$idea = $this->idea->find($id);
		$languages = Language::active()->get();
		
        return view('admin.idea.edit', [
            'idea' => $idea,
			'languages' => $languages
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idea $idea)
    {
        $idea = $this->idea->update($request, $id);

        return redirect()->back()->withSuccess('Идея была успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        $idea->delete();
        return redirect()->back()->withSuccess('Идея была успешно удалена!');
    }
}
