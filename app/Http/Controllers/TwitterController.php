<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Funciones\Contador;
use App\AppsTwitter;
use App\PerfilesTwitter;
use App\Http\Controllers\Mobile_Detect;


class TwitterController extends Controller
{

    public function index()
    {
       

        return view('circulo.index2');
    }
    public function generar(Request $request)
    {
        $color = list($r, $g, $b) = array_map('hexdec', str_split(str_replace('#','',$request->input('color')), 2));
        session(['color' => $color]);

        $app = AppsTwitter::find(1);

        $consumer_key = $app->token;
        $consumer_secret = $app->secret;
        $consumer_callback = 'http://chirpty.me/callback';


        $connection = new TwitterOAuth($consumer_key, $consumer_secret);

        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $consumer_callback));

        session(['oauth_token' => $request_token['oauth_token']]);
        session(['oauth_token_secret' => $request_token['oauth_token_secret']]);

        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

        return redirect($url);
    }



    public function callback(Request $request)
    {

        $app = AppsTwitter::find(1);

        $consumer_key = $app->token;
        $consumer_secret = $app->secret;
        define('CONSUMER_KEY', $consumer_key);
        define('CONSUMER_SECRET', $consumer_secret);


        $request_token = [];
        $request_token['oauth_token'] = session('oauth_token');
        $request_token['oauth_token_secret'] = session('oauth_token_secret');

        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $request_token['oauth_token'], $request_token['oauth_token_secret']);

        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $request['oauth_verifier']]);


        $guardar = new PerfilesTwitter();

        $guardar->oauth_token = $access_token['oauth_token'];
        $guardar->oauth_secret = $access_token['oauth_token_secret'];
        $extra = $this->actualizarPerfil($access_token['screen_name']);
        $guardar->twitter_id = $access_token['user_id'];
        $guardar->seguidores = $extra->followers_count;
        $guardar->activa = 1;
        $guardar->dir_ip = $this->getIp();
        $guardar->origen = $this->getOrigen();

        $guardar->apps_twitter_id = 1;
        $guardar->screen_name = $access_token['screen_name'];
        $guardar->save();

        session(['centinela'=>'si']);

        return redirect()->route('twitter', ['user' => $access_token['screen_name']]);
    }


    public function CrearCirculo($user)
    {

        //Verificar si ya ha autorizado la API
        if(session('centinela')!='si'){
             return redirect()->route('inicio');
        }
        //ACA SE DEFINE CUANTAS FOTOS TENDRÁ CADA CIRCULO
        $primer_circulo = 8;
        $segundo_circulo = 15;
        $tercer_circulo = 26;
        $nombre_web = "Chirpty.me";
        // Se obtiene datos de la APP
        $app = AppsTwitter::find(1);
        $consumer_key = $app->token;
        $consumer_secret = $app->secret;


        $connection = new TwitterOAuth($consumer_key, $consumer_secret);
        $statuses = $connection->get('statuses/user_timeline', ['screen_name' => $user, 'count' => 200]);
        // Se obtiene foto del usuario
        $filename = str_replace('_normal', '_400x400', $statuses[0]->user->profile_image_url_https);

        $vectorr = [];
        $contadorrr = new Contador();
        $contadorrr->contarRT($statuses, $vectorr); //Lista de usuarios, fotos y repetitos.

        $statuses = $connection->get('favorites/list', ['screen_name' => $user,'count'=>200]);

        $contadorrr->contarFAV($statuses, $vectorr);


        $vector = []; // Se crea vector ginal
        foreach ($vectorr as $nombre => $resultado) {
            $vector[] =  array(
                'username' => $nombre,
                'img' => $resultado['img'],
                'cont' => $resultado['cont']
            );
        }
        //Ordenamos Descendentemente
        usort($vector, function ($a, $b) {
            return $b['cont'] - $a['cont'];
        });



        $coloraux= session('color');
        //******************CREAMOS LA IMAGEN CENTRAL***************

        $fondo = imagecreatetruecolor(1000, 1000); // Create 1000x1000 image
        $color_fondo = imagecolorallocate($fondo,$coloraux[0],$coloraux[1], $coloraux[2]); // Lo pintamos

        imagefill($fondo, 0, 0, $color_fondo);

        $original = $recortada = $contadorrr->circulo($filename, '2');

        $wb = imagesx($fondo); // Bakground width
        $wi = imagesx($original); // Image width
        $hb = imagesy($fondo);
        $hi = imagesy($original);
        $original = imagescale($original, $wi * 0.54, $hi * 0.54);
        $wi = imagesx($original); // Image width
        $hi = imagesy($original);

        //Want to center in the middle of the image, so calc ($wb/2-$wi/2)
        imagecopy($fondo, $original, ($wb / 2 - $wi / 2), ($hb / 2 - $hi / 2), 0, 0, imagesx($original), imagesy($original));

        //******************CREAMOS PRIMER CIRCULO***************

        /* En caso de que el usuario no tenga interacciones, se crea una imagen
        con su foto de perfil en el centro */

        if (count($vector) == 0) {

            $rand = uniqid() . '.png';

            imagepng($fondo, 'imagenes/' . $rand);
            $aux = 'imagenes/' . $rand;

            echo "<img src='http://chirpty.me/" . $aux . "'></img>";
            imagedestroy($fondo);
            die();
        }
        ////*********************************************************/
        if ((!count($vector) >= $primer_circulo)) {
            $primer_circulo = count($vector);
        }

        $otro = (360 / $primer_circulo) * (pi() / 180);
        $aux = 0;

        $cont = 1;
        $contador = 1;
        foreach ($vector as $id => $img) {

            $original = $contadorrr->circulo($img['img'], 2);



            $original = imagescale($original, 115, 115);

            $centerX = cos($aux + 0.5) * 191;
            $centerY = sin($aux + 0.5) * 191;
            imagecopy($fondo, $original, $centerX + 500 - imagesx($original) / 2, $centerY + 500 - imagesy($original) / 2, 0, 0, imagesx($original), imagesy($original));

            $aux = $otro * $cont;
            $cont++;
            if ($contador == 8) {
                break;
            }
            $contador++;
        }
        $circulo_uno = array_slice($vector,0,$primer_circulo);
        \array_splice($vector, 0, $primer_circulo);


        //******************CREAMOS SEGUNDO CIRCULO***************
        //var_dump($vector);

        if (!(count($vector) >= $segundo_circulo)) {
            $segundo_circulo = count($vector);
        }

        $otro = (360 / $segundo_circulo) * (pi() / 180);
        $aux = 0;
        $radio = $hb / 2;

        $cont = 1;
        $contador = 1;
        foreach ($vector as $img) {

            $original = $contadorrr->circulo($img['img'], 2);


            $wi = imagesx($original); // Image width
            $hi = imagesy($original);
            $original = imagescale($original, 115, 115);

            $centerX = cos($aux + 0.5) * 313;
            $centerY = sin($aux + 0.5) * 313;
            //Want to center in the middle of the image, so calc ($wb/2-$wi/2)
            imagecopy($fondo, $original, $centerX + 500 - imagesx($original) / 2, $centerY + 500 - imagesy($original) / 2, 0, 0, imagesx($original), imagesy($original));

            $aux = $otro * $cont;
            $cont++;
            if ($contador == $segundo_circulo) {
                break;
            }
            $contador++;
        }
        $circulo_dos = array_slice($vector,0,$segundo_circulo);

        \array_splice($vector, 0, $segundo_circulo);


        //******************CREAMOS TERCER CIRCULO***************

        if (!(count($vector) >= $tercer_circulo)) {
            $tercer_circulo = count($vector);
        }


        $otro = (360 / 26) * (pi() / 180);
        $aux = 1.55398;

        $cont = 1;
        $contador = 1;
        foreach ($vector as $img) {

            $original = $contadorrr->circulo($img['img'], 2);



            $original = imagescale($original, 100, 100);

            $centerX = cos($aux + 0.5) * 429;
            $centerY = sin($aux + 0.5) * 429;
            //Want to center in the middle of the image, so calc ($wb/2-$wi/2)
            imagecopy($fondo, $original, $centerX + 500 - imagesx($original) / 2, $centerY + 500 - imagesy($original) / 2, 0, 0, imagesx($original), imagesy($original));

            $aux = $aux + $otro;
            $cont++;

            if ($contador == $tercer_circulo) {
                break;
            }
            $contador++;
        }

        $color_texto = imagecolorallocate($fondo, 101,98, 98);
        imagettftext($fondo,35,0,820,960,$color_texto,'imagenes/Summerbee.ttf',$nombre_web);

        $rand = uniqid();

        imagepng($fondo, 'imagenes/' . $rand.'.png');
        
        imagedestroy($fondo);
        session(['centinela'=>'no']);

        $circulo_tres = array_slice($vector,0,26);

        return view('circulo.resultado',compact('rand','circulo_uno','circulo_dos','circulo_tres'));

    }



    ///////////////// FUNCIONES /////////////////////////////////////

    public function actualizarPerfil($objeto)
    {


        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

        $statues = $connection->get("users/show", ["id" => $objeto]);



        return $statues;
    }

    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    public function getOrigen()
    {
        $detect = new Mobile_Detect;
        $origen = "";
        if ($detect->isMobile()) {
            $origen = "TELEFONO";
        } elseif ($detect->isTablet()) {
            $origen = "TABLET";
        } else {
            $origen = "ORDENADOR";
        }
        return $origen;
    }
}
