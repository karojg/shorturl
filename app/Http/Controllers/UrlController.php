<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Url;

class UrlController extends Controller
{
	/** @var Url */
	protected $url;


	/**
	* Create a new controller instance.
	* We are using dependency injection to avoid the usage
	* of creating a new instance.
	*
	* @return void
	*/
	public function __construct(Url $url, Request $request)
	{
		$this->url = $url;
		$this->request = $request;
	}

	/**
	 * Return all the urls
	 */
	public function index() {

		$urls = $this->url->all();

		return $urls;
	}

	/**
	 * Encode the URL
	 */
	public function encode(Request $request) {
		return $this->url->get_url($request);
  }
}
