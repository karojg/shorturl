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
    // Get url
    // $url_path = $this->create([
    //   'url' => $string->input('url')
    // ]);

    // Get url id
    // $url_id = $url_path->id;
    // // Encodes url
    // $url_encoded = $this->encode($url_id);
    // // Gets encoded url
    // $update_url_encoded = $this->update_url_encode($url_id, $url_encoded);
    // // Decodes url
    $url_decode = $this->decode($string);

    return $url_decode;
  }


	public static function encode($num) {
		$str = '';

		while ($num > 0) {
			$str = self::ALPHABET[($num % self::BASE)] . $str;
			$num = (int) ($num / self::BASE);
    }

    update_url_encode($num, $str);

		return $str;
  }

  public function update_url_encode($url_id, $url_encoded) {
    // Find the url you want to update
    $url = $this->find($url_id);

    // Return error if not found
    if (empty($url)) {
      return "No data found.";
    }

    $url->update(['url_encoded' => $url_encoded]);
  }


	public static function decode($str) {
		$num = 0;
		$len = strlen($str);

		for ($i = 0; $i < $len; $i++) {
			$num = $num * self::BASE + strpos(self::ALPHABET, $str[$i]);
		}

    return $num;
	}
}
