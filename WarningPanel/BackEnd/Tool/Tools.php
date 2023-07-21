<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Tool;
/**
 * Class Tools
 * @package App\Tool
 */
class Tools
{


    /** 
    *@param $string
    *@return bool
    */
    // public static function Log($msg)
    // {
    //     $DATE= date('j-n-Y \a H:i:s');

    //     if(file_exists('__log__.txt'))
    //     {
            
    //         $file = fopen('__log__.txt' , 'a+');
    //         $_msg = $DATE . ' : ' . $msg .PHP_EOL;
    //         fwrite($file , $_msg);
    //         fclose($file);
    //         echo 'ui';
    //         return true;

    //     } else {

    //         return false;
    //     }

    // }

    //On regarde si le type de string est un nombre
    /**
     * @param $string
     * @return int|string
     */
    public static function bdd($string)
    {
        if(ctype_digit($string))
        {
            $string = intval($string);
        }//END OF IF
        //Pour les autres types
        else{

            $string = mysqli_real_escape_string($string);
            $string = addcslashes($string , '%_');
        }//END OF ELSE

        return $string;
    }//END OF FUNCTION

    /**
     * @param $string
     * @return string
     */
    public static function html($string)
    {

        return htmlentities($string);
    }

    /**
     * @param $password
     * @return bool|false|string
     */
    public static function hashMake($password)
    {


        $hash = password_hash($password, PASSWORD_BCRYPT);

        if ($hash === false) {
            throw new RuntimeException('Bcrypt hashing not supported.');
        }

        return $hash;
    }

    /**
     * V�rifie qu'un password correspond � un hachage
     * @param $password
     * @param $hashedPassword
     * @return bool
     */
    public static function hashCheck($password, $hashedPassword)
    {
        if (strlen($hashedPassword) === 0) {
            return false;
        }

        return password_verify($password, $hashedPassword);
    }

    /**
     * @param $login
     * @return bool
     */
    public static function LoginVerif($login){
        $regex = '/^[a-zA-Z][\p{L}-]*$/';

        //NAME IS GOOD?
        if( preg_match($regex, $login)) {

            $v = strlen($login) <= 20 && strlen($login) > 0 ? true : false;
            return $v;

        }



    }

    /**
     * @param $pswd
     * @return bool
     */
    public static function PasswordVerif($pswd){

        $regex = '/^[a-zA-Z][\p{L}-]*$/';

        $v = preg_match($regex, $pswd) ? (strlen($pswd) <= 20 && strlen($pswd) > 0 ? true : false) : false;

        return $v;
    }

    /**
     * @param $_author
     * @param $player
     * @param $number
     * @return bool
     */
    public static function SendWebhook($_author, $player, $number){

        $url = "https://discordapp.com/api/webhooks/713680611100852273/6RRrJ63VNt6-J2VBVtyHfWcU2RCATlcR03VVkvD_pgwjKF4v-yMKmVr4O-IZdKVhk2PG";
        $DATE= date('j-n-Y \a H:i:s');//Heure et date de la vente
        $timestamp = date('Y-m-d').'T'.date('H:i:s').'.'.date("v");

        $hookObject = json_encode([
            /*
             * The general "message" shown above your embeds
             */
            // "content" => "A message will go here",
            /*
             * The username shown in the message
             */
            "username" => "WarningBot",
            /*
             * The image location for the senders image
             */
            "avatar_url" => "https://i0.wp.com/livewallpaper.info/wp-content/uploads/2017/08/Nanatsu-no-Taizai-Sin-of-Greed-Ban-wallpaper-wp4009981.jpg?ssl=1",
            /*
             * Whether or not to read the message in Text-to-speech
             */
            "tts" => false,
            /*
             * File contents to send to upload a file
             */
            // "file" => "",
            /*
             * An array of Embeds
             */
            "embeds" => [
                /*
                 * Our first embed
                 */
                [
                    // Set the title for your embed
                    "title" => "[" . $player . "]". " has 3 warnings",

                    // The type of your embed, will ALWAYS be "rich"
                    "type" => "rich",

                    // A description for your embed
                    "description" => "",

                    // The URL of where your title will be a link to
                    "url" => "",

                    /* A timestamp to be displayed below the embed, IE for when an an article was posted
                     * This must be formatted as ISO8601
                     */
                    // "timestamp" => $DATE,
                    // "timestamp" => $timestamp,
                    // "timestamp" =>

                    // The integer color to be used on the left side of the embed
                    "color" => hexdec( "FFFFFF" ),

                    // Footer object
                    "footer" => [
                        "text" => "3 warnings : Apply a ban to this player.",
                        "icon_url" => "https://c.wallhere.com/photos/50/44/Pulp_Fiction_movies_monochrome_minimalism-40601.png"
                    ],

                    // Image object
                    "image" => [
                        "url" => "https://c.wallhere.com/photos/50/44/Pulp_Fiction_movies_monochrome_minimalism-40601.png"
                    ],

                    // Thumbnail object
                    "thumbnail" => [
                        "url" => "https://c.wallhere.com/photos/50/44/Pulp_Fiction_movies_monochrome_minimalism-40601.png"
                    ],

                    // Author object
//                    "author" => [
//                      "name" => $_author,
//                      "url" => "https://i.pinimg.com/originals/98/f6/07/98f607e555b63b0cdc3b9f4bbafdf25d.png"
//                    ],

                    // Field array of objects
                    "fields" => [
                        // Field 1
                        [
                            "name" => "Player",
                            "value" => $player,
                            // "value" => "John",
                            "inline" => true
                        ],
                        // Field 2
                        [
                            "name" => "Number",
                            "value" => $number,
                            // "value" => "Kalash",
                            "inline" => true
                        ]
                    ]
                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );



        $ch = curl_init();

        curl_setopt_array( $ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $hookObject,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ]
        ]);

        $response = curl_exec( $ch );
        //echo $response;
        curl_close( $ch );



        return true;
    }




}