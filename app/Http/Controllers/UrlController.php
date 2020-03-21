<?php

namespace App\Http\Controllers;
use App\Models\Url;
use App\Services\UrlPopo;
use Illuminate\Http\Request;

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
	public function __construct(Url $url, UrlPopo $urlpopo, Request $request)
	{
    $this->model = $url;
    $this->popo = $urlpopo;
    $this->request = $request;
  }

	/**
	 * Return all the urls
	 */
  public function encode()
  {
    // Popo
    $popoReturn = $this->popo->getEncodedUrls($this->request);

    // Model
    $modelReturn = $this->model->get_url($popoReturn);

    return $modelReturn;
  }
}
