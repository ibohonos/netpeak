<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal;
use App\Author;
use Image;
use Auth;

class HomeController extends Controller
{
	private $data = [];

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['journals'] = Journal::orderByDesc('date_prod')->orderBy('title')->paginate(5)->onEachSide(3);

		return view('home', $this->data);
	}

	public function createJournal()
	{
		if (!Auth::user()->is_admin) {
			return redirect(route('home'))->with(['status' => 'Permission denied']);
		}

		$this->data['authors'] = Author::all();

		return view('create_journal', $this->data);
	}

	public function saveJournal(Request $request)
	{
		if (!Auth::user()->is_admin) {
			return redirect(route('home'))->with(['status' => 'Permission denied']);
		}

		$request->validate([
			'title' => 'required|string|min:3',
			'short_text' => 'string|max:500',
			'authors' => 'required|array|min:1',
			'image' => 'file|image|mimes:jpeg,png|max:' . 5 * 1024 * 1024,
			'date_prod' => 'required'
		]);

		if ($request->hasFile('image')) {
			$img = $request->file('image');

			$imageCrop = Image::make($img)->encode($img->getClientOriginalExtension());

			if ($imageCrop->width() > 300 || $imageCrop->height() > 500) {
				$imageCrop->resize(300, 500, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				});
			}
			$fileName = time() . '-' . str_slug($request->title, '_') . '.' . $img->getClientOriginalExtension();
			$filePath = storage_path('app/public/images') . '/' . $fileName;

			$imageCrop->save($filePath);

			$fileUrl = '/storage/images/' . $fileName;
		} else {
			$fileUrl = "";
		}

		$journal = new Journal;

		$journal->title = $request->title;
		$journal->text = $request->short_text;
		$journal->image = $fileUrl;
		$journal->date_prod = $request->date_prod;

		$journal->save();
		$journal->authors()->attach($request->authors);

		return redirect()->back()->with(['status' => 'Journal saved!']);
	}

	public function createAuthor()
	{
		if (!Auth::user()->is_admin) {
			return redirect(route('home'))->with(['status' => 'Permission denied']);
		}
		return view('create_author');
	}

	public function saveAuthor(Request $request)
	{
		if (!Auth::user()->is_admin) {
			return redirect(route('home'))->with(['status' => 'Permission denied']);
		}

		$request->validate([
			'last_name' => 'required|string|min:3',
			'first_name' => 'required|string'
		]);

		$author = new Author;

		$author->first_name = $request->first_name;
		$author->last_name = $request->last_name;

		$author->save();

		return redirect()->back()->with(['status' => 'Author saved!']);
	}

	public function deleteJournal(Request $request)
	{
		if (!Auth::user()->is_admin) {
			return redirect(route('home'))->with(['status' => 'Permission denied']);
		}

		$journal = Journal::find($request->journal_id);

		$journal->delete();

		return redirect()->back()->with(['status' => 'Journal deleted!']);
	}

	public function editJournal($id)
	{
		if (!Auth::user()->is_admin) {
			return redirect(route('home'))->with(['status' => 'Permission denied']);
		}

		$arr = [];

		$this->data['journal'] = Journal::find($id);
		$this->data['authors'] = Author::all();

		foreach ($this->data['journal']->authors as $res) {
			$arr[] = $res->id;
		}

		$this->data['id_authors'] = $arr;

		return view('edit_journal', $this->data);
	}

	public function updateJournal(Request $request)
	{
		if (!Auth::user()->is_admin) {
			return redirect(route('home'))->with(['status' => 'Permission denied']);
		}

		$request->validate([
			'title' => 'required|string|min:3',
			'short_text' => 'string|max:500',
			'authors' => 'required|array|min:1',
			'image' => 'file|image|mimes:jpeg,png|max:' . 5 * 1024 * 1024,
			'date_prod' => 'required'
		]);

		if ($request->hasFile('image')) {
			$img = $request->file('image');

			$imageCrop = Image::make($img)->encode($img->getClientOriginalExtension());

			if ($imageCrop->width() > 300 || $imageCrop->height() > 500) {
				$imageCrop->resize(300, 500, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				});
			}
			$fileName = time() . '-' . str_slug($request->title, '_') . '.' . $img->getClientOriginalExtension();
			$filePath = storage_path('app/public/images') . '/' . $fileName;

			$imageCrop->save($filePath);

			$fileUrl = '/storage/images/' . $fileName;
		} else {
			if ($request->img_url) {
				$fileUrl = $request->img_url;
			} else {
				$fileUrl = "";
			}
		}

		$journal = Journal::find($request->journal_id);

		$journal->title = $request->title;
		$journal->text = $request->short_text;
		$journal->image = $fileUrl;
		$journal->date_prod = $request->date_prod;

		$journal->save();
		$journal->authors()->attach($request->authors);

		return redirect()->back()->with(['status' => 'Journal updated!']);
	}
}
