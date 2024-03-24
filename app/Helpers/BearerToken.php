<?php

namespace App\Helpers;

use Illuminate\Http\Request;

final class BearerToken
{
    public static function validate(Request $request): bool
    {
        $authHeader = $request->header('Authorization');
        $string = $request->bearerToken();
        if (!is_null($authHeader)) {
            if (preg_match('/^[{}\[\]\(\)]*$/', $string)) {
                $stack = [];
                $mapping = [
                    '{' => '}',
                    '[' => ']',
                    '(' => ')'
                ];
                foreach (str_split($string) as $character) {
                    if (array_key_exists($character, $mapping)) {
                        $stack[] = $character;
                    } elseif (in_array($character, $mapping)) {
                        if (empty($stack) || $mapping[array_pop($stack)] != $character) {
                            return false;
                        }
                    }
                }
                return empty($stack);
            } elseif (is_null($string)) {
                return true;
            }
        }
        return false;
    }
}
