<?php

namespace App\Services;

class ServiceUrlShortener
{

  const ALPHABET = '23456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ-_';
	const BASE = 51;

	public function encode($num) {
		$str = '';

    // While id is still greater than 0 keep iterating to obtain the encoded url
		while ($num > 0) {
			$str = self::ALPHABET[($num % self::BASE)] . $str;
			$num = (int) ($num / self::BASE);
    }

		return $str;
  }
}
