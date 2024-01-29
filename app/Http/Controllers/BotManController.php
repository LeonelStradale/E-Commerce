<?php
namespace App\Http\Controllers;

use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {

            if ($message == 'HOLA' || $message == 'Hola' || $message == 'hola') {
                $this->askName($botman);
            } else {
                $botman->reply("Inicia la conversación escribiendo un 'Hola'.");
            }

        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
        $botman->ask('¡Hola! ¿Cuál es tu nombre?', function (Answer $answer) {
            $name = $answer->getText();
            
            $this->say('Un gusto en conocerte ' . $name . '.');

            $description = "Bienvenido a nuestro ecommerce de venta de productos en general. Ofrecemos una amplia variedad de productos de alta calidad a precios competitivos. Desde electrónicos hasta artículos para el hogar, tenemos todo lo que necesitas. ¡Explora nuestro catálogo y descubre las mejores ofertas!";

            $this->say($description);
        });
    }
}