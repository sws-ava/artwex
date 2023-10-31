<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Repositories\Faq\FaqRepository;
use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;

class FaqController extends Controller
{
	private $model_name;

    private $faq;

    /**
     * construct
     */
    public function __construct(FaqRepository $faq)
    {
        parent::__construct();
        $this->model_name = 'Чаво';
        $this->faq = $faq;
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();

        return view('admin.faq.index', [
            'faqs' => $faqs
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
        return view('admin.faq.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFaqRequest $request)
    {
        $faq = $this->faq->store($request);

        return redirect()->back()->withSuccess('Вопрос был успешно добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$faq = $this->faq->find($id);
		$languages = Language::active()->get();
		
        return view('admin.faq.edit', [
            'faq' => $faq,
			'languages' => $languages
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $faq = $this->faq->update($request, $id);

        return redirect()->back()->withSuccess('Вопрос был успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->back()->withSuccess('Вопрос был успешно удален!');
    }
}
