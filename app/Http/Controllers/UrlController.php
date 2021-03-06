<?php

namespace App\Http\Controllers;
use App\Models\Url;
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
	public function __construct(Url $url, Request $request)
	{
    $this->model = $url;
    $this->request = $request;
  }

	/**
	 * Inits the encode process
	 */
  public function encode()
  {
    // Call the Model, that will call the Service
    $urlModel = $this->model->encode_url($this->request);

    // Return a json APP url and the encoded url
    $local = env('APP_URL');
    return response()->json([
      'encoded_url' => $local . $urlModel,
    ]);
  }
}
