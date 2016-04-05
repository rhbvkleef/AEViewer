<?php

namespace App\Helpers;

class APITokenGenerator {
  protected $alphabet;
  protected $alphabet_length;

  public function __construct($alphabet = null) {
    if($alphabet !== null) {
      $this->setAlphabet($alphabet);
    }else {
      $this->setAlphabet(
        implode(range('a', 'z')) .
        implode(range('A', 'Z')) .
        implode(range(0, 9))
      );
    }
  }

  public function setAlphabet($alphabet) {
    $this->alphabet = $alphabet;
    $this->alphabet_length = strlen($alphabet);
  }

  public function generate($length = 32) {
    $token = '';
    for($i = 0; $i < $length; $i++) {
      $token .= $this->alphabet[$this->getRandomInteger(0, $this->alphabet_length)];
    }
    return $token;
  }

  protected function getRandomInteger($min, $max) {
    $range = $max - $min;

    if($range < 0) {
      return $min;
    }

    $bytelen = (int) (log($range, 2) / 8) + 1;
    $bitlen = (int) log($range, 2) + 1;
    $bitmask = (int) (1 << $bitlen) - 1;

    do {
      $random = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

      //Bitmask irrelevant bits
      $random = $random & $filter;
    }while($random >= $range);

    return $min + $random;
  }
}
