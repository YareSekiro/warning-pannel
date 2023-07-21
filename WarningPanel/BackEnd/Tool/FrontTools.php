<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Tool;


/**
 * Class FrontTools
 * @package App\Tool
 */
class FrontTools
{

    public static function Webhook($user, $number, $reason, $staff){
            //ALERTE WEBHOOK POUR LES ARMURIERS
      // $url = 'https://discordapp.com/api/webhooks/686172758446833736/LwmxrgYEeLt06x4EsBSQ2FQmc4zlvhPM8LMLbCValM_7wnyjoIubGWsAPl-va1YflqCf';
      $url = 'https://discordapp.com/api/webhooks/761673458366808106/0HHYWNTy09UJ2XZY6ZJvnn7CQ7sBW0EVL_N-SUMOXw_0mqdWqeBfuaiFhNDFp4U7NuQ5';
      // $url = 'https://discordapp.com/api/webhooks/666424463197208576/YfFPc0n25AmEwybMOm0mxkWB7nrXQTDX11-K2omMa1ktxQrHnyIm-USweeFS1nmzrJqL';
      

      $hookObject = json_encode([
          /*
          * The general "message" shown above your embeds
          */
          // "content" => "A message will go here",
          /*
          * The username shown in the message
          */
          "username" => $staff,
          /*
          * The image location for the senders image
          */
          "avatar_url" => "https://thumbs.gfycat.com/WaryFantasticHarrier-size_restricted.gif",
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
                  "title" => "Ajout d'avertissement",
                  
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
                      "text" => "Coucou negro",
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
                  "author" => [
                      "name" => $staff,
                      "url" => "https://thumbs.gfycat.com/WaryFantasticHarrier-size_restricted.gif"
                  ],
                  
                  // Field array of objects
                  "fields" => [
                      // Field 1
                      [
                          "name" => "Player",
                          "value" => $user,
                          // "value" => "John",
                          "inline" => true
                      ],
                      // Field 2
                      [
                          "name" => "Number",
                          "value" => $number,
                          // "value" => "Kalash",
                          "inline" => true
                      ],
                      // Field 3
                      [
                          "name" => "Reason",
                          "value" => $reason,
                          // "value" => "Prix",
                          "inline" => false
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
              "Content-Type: application/json; charset=utf-8"
          ]
      ]);
      
      $response = curl_exec( $ch );
      echo $response;
      curl_close( $ch );
    }

    /**
     * @param $message
     * @param $id
     * @param $_isLogout
     */
    public static function CreateModal($message, $id, $_isLogout){

        echo'
         <div class="modal fade" id="'. $id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">.'.$message.'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>';

                    if($_isLogout) echo' <a class="btn btn-primary" href="../BackEnd/Script/LogoutUser.php">Logout</a>';


                echo '
              </div>
              </div>
          </div>
        </div>

        ';


    }

    /**
     * @param $title
     * @param $see_id
     * @param $id_card_body
     * @param $wanted
     * @param $value
     * @param $page
     * @param $icon
     */
    public static function CreateTable($title, $see_id , $id_card_body, $wanted, $value, $page, $icon){

        $_file = "../BackEnd/Tool/config.json";
        $_table_info = file_get_contents($_file);
        $_table_data = json_decode($_table_info);
        $size = $_table_data->$wanted->Column;
        $getFunction = [];
        echo'
        <div class="card shadow mb-4" style="margin-top:1%">
            <div class="card-header py-3" style="display:flex">

                <h6 class="m-0 font-weight-bold text-primary" style="margin-left:2%">
                      | <i id="'.$see_id.'" class="fas fa-plus" style="margin-left:0%"></i> |

                ' . $title . '

                </h6>';
                if($icon) {

                    echo '
                    <i id="adding" class="fas fa-user-plus"></i>';
                    if($wanted != "panel"){
                      echo'
                      <i id="deleting" class="fas fa-user-times"></i>';
                    }
                    if($wanted == "panel"){
                        echo'
                    <i id="searching" class="fas fa-search"></i>';
                    }

                }
                echo '

            </div>
            <div class="card-body" id="'.$id_card_body.'" style="display:none">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>';

                        for($i = 0; $i < $size; $i++){
                            echo '<th>'. $_table_data->$wanted->Name[$i] . '</th>';
                        }

                 echo '       
                      </tr>
                    </thead>
                    <tbody>';



                        if($page == "panel" && $wanted == "panel") {


                            if($value["value"]) {

                                for ($i = 0; $i < sizeof($value["value"]); $i++) {

                                    //$secondParameterValue = $value[$i]->$getFunction[0]();
                                    ;
//                                   echo '<tr style="cursor:pointer" onClick="Redirect("'.str_replace("_" , " ", $value["value"][$i]->getPlayer()).'")">
                                   echo '<tr style="cursor:pointer" id="PanelParent'.$i.'" onClick="document.location.href=`index.php?redirect=warning&player='. str_replace(" " , "_" , $value["value"]["$i"]->getPlayer()).'`">
                        
                                    <td class="column1" id="Panel' . $_table_data->$wanted->Name[0] . $i .'">' . str_replace("_", " ", $value["value"][$i]->getId()) . '</td>
                                    <td class="column2" id="Panel' . $_table_data->$wanted->Name[1] . $i .'">' . str_replace("_", " ", $value["value"][$i]->getPlayer()) . '</td>
                                    <td class="column3" id="Panel' . $_table_data->$wanted->Name[2] . $i .'">' . str_replace("_", " ", $value["value"][$i]->getTotal()) . '</td>
                                    <td class="column4" id="Panel' . $_table_data->$wanted->Name[3] . $i .'">' . str_replace("_", " ", $value["date_s"][$i]) . '</td>
                                    <td class="column5" id="Panel' . $_table_data->$wanted->Name[4] . $i .'">' . str_replace("_", " ", $value["date_e"][$i]) . '</td>
                                
                                </tr>
                                
                                
                                ';
                                }
                            }
                            
                            
                        }elseif($page == "panel" && $wanted == "banlist"){


                            if($value) {


                                for ($i = 0; $i < sizeof($value); $i++) {
                                    echo '<tr style="cursor:pointer" >
                            
                                    <td class="column1" id="['.$i.']BanList' . $_table_data->$wanted->Name[0] . '">' . str_replace("_", " ", $value[$i]->getId()) . '</td>
                                    <td class="column2" id="['.$i.']BanList' . $_table_data->$wanted->Name[1] . '">' . str_replace("_", " ", $value[$i]->getPlayer()) . '</td>
                                    <td class="column3" id="['.$i.']BanList' . $_table_data->$wanted->Name[2] . '">' . str_replace("_", " ", $value[$i]->getBannumber()) . '</td>
                                
                                </tr>
                               ';
                                }
                            }


                        }


                        elseif($page == "warning" && $wanted == "warning"){
                            if($value) {
                                for($i = 0; $i < sizeof($value); $i++){
                                    echo '<tr style="cursor:pointer" class="WarningTab" onclick="javascript:Warning(this)" id="'.$value[$i]->getId().'">

                            
                                        <td class="column1 id-'.$value[$i]->getId().'" id="'.$i.'Warning' . $_table_data->$wanted->Name[0] . '">' . str_replace("_", " ", $value[$i]->getId()) . '</td>
                                        <td class="column2 id-'.$value[$i]->getId().'" id="'.$i.'Warning' . $_table_data->$wanted->Name[1] . '">' . str_replace("_", " ", $value[$i]->getPlayer()) . '</td>
                                        <td class="column3 id-'.$value[$i]->getId().'" id="'.$i.'Warning' . $_table_data->$wanted->Name[2] . '">' . str_replace("_", " ", $value[$i]->getNumber()) . '</td>
                                        <td class="column4 id-'.$value[$i]->getId().'" id="'.$i.'Warning' . $_table_data->$wanted->Name[3] . '">' . str_replace("_", " ", $value[$i]->getReason()) . '</td>
                                        <td class="column5 id-'.$value[$i]->getId().'" id="'.$i.'Warning' . $_table_data->$wanted->Name[4] . '">' . str_replace("_", " ", $value[$i]->getStaff()) . '</td>
                                        <td class="column6 id-'.$value[$i]->getId().'" id="'.$i.'Warning' . $_table_data->$wanted->Name[5] . '">' . str_replace("_", " ", $value[$i]->getDate_s()) . '</td>
                                        <td class="column7 id-'.$value[$i]->getId().'" id="'.$i.'Warning' . $_table_data->$wanted->Name[6] . '">' . str_replace("_", " ", $value[$i]->getDate_e()) . '</td>
                                    
                                    </tr>
                                   ';
                                }
                            }
                        } elseif($page == "user" && $wanted == "user"){

                                if($value) {


                                    for ($i = 0; $i < sizeof($value); $i++) {
                                        echo '<tr style="cursor:pointer" onclick="javascript:User(this)" id="'.$value[$i]->getId().'">
                               
                                    <td class="column1" id="['.$i.']User' . $_table_data->$wanted->Name[0] . '">' . str_replace("_", " ", $value[$i]->getId()) . '</td>
                                    <td class="column2" id="['.$i.']User' . $_table_data->$wanted->Name[1] . '">' . str_replace("_", " ", $value[$i]->getLogin()) . '</td>
                                    <td class="column3" id="['.$i.']User' . $_table_data->$wanted->Name[2] . '">' . str_replace("_", " ", $value[$i]->getPerm()) . '</td>
                                    <td class="column4" id="['.$i.']User' . $_table_data->$wanted->Name[3] . '">' . str_replace("_", " ", $value[$i]->getImg()) . '</td>
                                
                                </tr>
                               ';
                                    }
                                }

                        }


                        echo'
                                        
     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        ';

    }

    /**
     * @param $class
     * @param $title
     * @param $value
     */
    public static function CreateCard($class, $title, $value){

        echo ' 
        
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card ' . $class . ' shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">' . $title . '</div>

                      <div class="h5 mb-0 font-weight-bold text-gray-800">' . $value . '</div>
                    
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
        
        
        ';


    }

    /**
     * @param $title
     */
    public static function CreateHeaderTitle($title){
        echo '
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">' . $title . '</h1>
          </div>
        ';
    }

    /**
     * @param $id
     * @param $value
     */
    public static function CreateAdvancedModal($id, $value){

            echo '
                                
                                    <!-- Modal -->
                    <div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                          
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <ul id="myUL">';

                          if($value){
                            for($i = 0 ; $i < sizeof($value) ; $i++)
                            {
                              //echo\'<div class="text-center" id="voitures">\'.$vehicles[$i].\'</div>\';
  //                            echo '<li><a style="cursor:pointer" href="index.php?redirect=warning&player='. $value[$i]->getPlayer() .'">Name : <span style="color:#6f42c1">' . $value[$i]->getPlayer() . '</span> | Warnings : ' . $value[$i]->getTotal() .' </a></li>';
                              echo '<li><a style="cursor:pointer" href="index.php?redirect=warning&player='. $value[$i]->getPlayer() .'"><i class="fas fa-user"></i> <span style="color:#6f42c1">' . $value[$i]->getPlayer() . '</span>  |<i class="fas fa-exclamation-triangle"></i>Warning(s) : ' . $value[$i]->getTotal() .' </a></li>';
                            }
                          }
                    
                          echo '
                          </ul>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                          </div>
                        </div>
                      </div>
                    </div>
            
            
            ';


    }

    /**
     * @param $type
     * @param $id
     * @param $name
     * @param $class
     * @param $target
     * @param $content
     */
    public static function CreateButton($type, $id, $name, $class, $target, $content)
    {
        if($target) {
            echo '<button type = "' . $type . '" id = "' . $id . '" name = "' .$name. '" class="' . $class . '" data-toggle = "modal" data-target = "' . $target . '" >' . $content . '</button >';
        } else {
            echo '<button type = "' . $type . '" id = "' . $id . '" name = "' .$name. '" class = "' . $class . '">' .$content. '</button>';
        }
    }

    /**
     * @param $container_id
     * @param $display
     * @param $img
     * @param $title
     * @param $form_id
     * @param $form_class
     * @param $action
     * @param $_total_input
     * @param $_id_name_placeholder
     * @param $button_content
     */
    public static function CreateForm($container_id, $display, $img, $title, $form_id, $form_class, $action, $_total_input, $_id_name_placeholder, $button_content){


        echo '
        
            
          <div class="container" id="'.$container_id.'" style="display:'.$display.'">
                
                <!-- Outer Row -->
                <div class="row justify-content-center">
                
                  <div class="col-xl-10 col-lg-12 col-md-9">
                
                    <div class="card o-hidden border-0 shadow-lg my-5">
                      <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                          <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image:url('.$img.')"></div>
                          <div class="col-lg-6">
                            <div class="p-5">
                              <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">'.$title.'</h1>
                              </div>
                              <div id="'.$form_id.'">
                                <form class="'.$form_class.'" action="'.$action.'" method="POST" >';

                                    for($i = 0; $i < $_total_input; $i++) {

                                        echo'
                                         <div class="form-group" >
                                          <input type = "text" class="form-control form-control-user" id = "'.$_id_name_placeholder['id'][$i].'" name = "'.$_id_name_placeholder['name'][$i].'" placeholder = "'.$_id_name_placeholder['msg'][$i].'" required autofocus >
                                        </div >';
                                    }

                                echo'
                                <hr>
                                <button type="submit" class="btn btn-primary btn-user btn-block">'.$button_content.'</button>
                                  
                                <hr>
                                </form>
                            </div>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                
                  </div>
                
                </div>
                </div>
                        
                        
        
        
        
        
        
        ';

    }









}