<?php

namespace App\Http\Controllers\Funciones;


class Contador
{
    function contarRT($statuses, &$aux)
    {

        foreach ($statuses as $status) {
            
            if (isset($status->retweeted_status->user->screen_name))
                if (array_key_exists($status->retweeted_status->user->screen_name, $aux)) {
                    $aux[$status->retweeted_status->user->screen_name]['cont']++;
                } else {
                    $aux[$status->retweeted_status->user->screen_name] = array(
                        'img' => str_replace('_normal', '_400x400', $status->retweeted_status->user->profile_image_url_https),
                        'cont' => 1
                    );
                }
        }
    }

    function contarFAV($statuses, &$vectorr)
    {
        foreach ($statuses as $status) {


            if (array_key_exists($status->user->screen_name, $vectorr)) {
                $vectorr[$status->user->screen_name]['cont']++;
            } else {
                $vectorr[$status->user->screen_name] = array(
                    'img' => str_replace('_normal', '_400x400', $status->user->profile_image_url_https),
                    'cont' => 1
                );
            }
        }
    }

    function circulo($original, $radio)
    {



        $src = imagecreatefromstring(file_get_contents($original));


        //$src = imagecreatefromjpeg($original);

        $w = imagesx($src);
        $h = imagesy($src);

        $newpic = imagecreatetruecolor($w, $h);
        imagealphablending($newpic, false);
        $transparent = imagecolorallocatealpha($newpic, 0, 0, 0, 127); //Hacer transparente la imagen

        $r = $w / $radio; //Radio del circulo 
        for ($x = 0; $x < $w; $x++)
            for ($y = 0; $y < $h; $y++) {
                $c = imagecolorat($src, $x, $y);
                $_x = $x - $w / 2;
                // echo $_x."\n";

                $_y = $y - $h / 2;
                if ((($_x * $_x) + ($_y * $_y)) < ($r * $r)) {
                    imagesetpixel($newpic, $x, $y, $c);
                } else {
                    imagesetpixel($newpic, $x, $y, $transparent);
                }
            }

        return $newpic;
    }
}
