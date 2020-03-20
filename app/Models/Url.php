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
		'url_path'
  ];

  const ALPHABET = '23456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ-_';
	const BASE = 51; // strlen(self::ALPHABET)

	public static function encode($num) {
		$str = '';

		while ($num > 0) {
			$str = self::ALPHABET[($num % self::BASE)] . $str;
			$num = (int) ($num / self::BASE);
		}

		return $str;
	}

	public static function decode($str) {
		$num = 0;
		$len = strlen($str);

        print_r($str);
		for ($i = 0; $i < $len; $i++) {
			$num = $num * self::BASE + strpos(self::ALPHABET, $str[$i]);
		}

		return $num;
	}
}
