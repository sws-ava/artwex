<?php

namespace App\Http\Controllers\Admin;

use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Http\Request;
use App\Traits\AuthorizeTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;

class TranslationController extends Controller
{
    // use AuthorizeTrait;

    private $model_name;
	
	private $langs = ['en', 'ru', 'uk'];

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->model_name = trans('app.model.translations');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$kinds = $this->langs;
        $langs = LanguageLine::all();

        return view('admin.translation.index', compact('langs', 'kinds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$langs = $this->langs;
        return view('admin.translation.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTranslationRequest $request)
    {
        $langs = LanguageLine::create($request->all());

        return redirect()->route('translation.index')->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Translation  $lang
     * @return \Illuminate\Http\Response
     */
    public function edit(LanguageLine $translation)
    {
		$langs = $this->langs;
        return view('admin.translation.edit', compact('translation', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Translation  $lang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTranslationRequest $request, LanguageLine $translation)
    {
        $translation->update($request->all());

        return redirect()->route('translation.index')->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }
	
	public function generate() 
	{
		$this->setLang('auth');
		$this->setLang('nav');
		$this->setLang('pagination');
		$this->setLang('passwords');
		$this->setLang('trans');
		$this->setLang('form');
		$this->setLang('messages');
		$this->setLang('placeholder');
	}
	
	private function setLang($group) 
	{
		$array = include resource_path('lang/en/'.$group.'.php');
		
		foreach ($array as $key => $value) {
			LanguageLine::create([
			  'group' => $group,
			  'key' => $key,
			  'text' => ['en' => $value, 'ru' => '', 'de' => ''],
			]);
		}
	}
}
