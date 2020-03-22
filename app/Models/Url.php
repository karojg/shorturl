<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Services\SingletonUrlShortner;

class Url extends Model
{
  /**
   * The attributes that are mass assignable
   *
   * @var array
   */
  protected $fillable = [
    'url',
    'url_encoded'
  ];

  /**
	 * Executes the call between the model and service
	 */
  public function encode_url($string)
  {
    // ServiceUrlShortener Service Instance
    $instanceService = SingletonUrlShortner::get_instance();
    $service = $instanceService->get_service();
    
    // Returns the url id at the DB
    $url_id = $this->store_url($string);
    // Returns the encoded url
    $encodes_url = $service->encode($url_id);
    // Stores the encoded url
    $stored_encoded_url = $this->store_encoded_url($url_id, $encodes_url);

    return $encodes_url;
  }

  /**
	* Stores the url and returns its id
	*/
  public function store_url($string)
  {
    // Get url and stores it
    $stored_url = $this->create([
      'url' => $string->input('url')
    ]);

    return $stored_url->id;
  }

  /**
	* Stores the encoded url
	*/
  public function store_encoded_url($url_id, $url_encoded)
  {
    // Finds position where to store the $url_encoded
    $url = $this->find($url_id);
    // Updates the encoded_url attribute
    $url->update(['url_encoded' => $url_encoded]);
  }
}
