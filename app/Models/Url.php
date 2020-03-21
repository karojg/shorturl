<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

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

  const ALPHABET = '23456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ-_';
	const BASE = 51; // strlen(self::ALPHABET);

  public function get_url($string) {
    // Get url and stores it
    $url_path = $this->create([
      'url' => $string->input('url')
    ]);

    // Get url id
    $url_id = $url_path->id;

    // Encodes url
    $url_encoded = $this->encode($url_id);
    // Stores encoded url
    $url_encoded_storage = $this->update_url_encode($url_id, $url_encoded);

    return $url_encoded;
  }


	public function encode($num) {
		$str = '';

    // while id is still greater than 0 keep iterating to obtain the encoded url
		while ($num > 0) {
			$str = self::ALPHABET[($num % self::BASE)] . $str;
			$num = (int) ($num / self::BASE);
    }

		return $str;
  }

  public function update_url_encode($url_id, $url_encoded) {
    // Find the url you want to update
    $url = $this->find($url_id);

    // Return error if not found
    if (empty($url)) return "No data found to update.";

    // Updates the encoded_url attribute
    $url->update(['url_encoded' => $url_encoded]);

    return $url;
  }
}
