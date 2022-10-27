<?php

add_action("admin_menu", "menuFunction");

function menuFunction()
{
   //menu and submenu
   $hook =  add_menu_page("Dashboard", "Dashboard", "administrator", "data_custom", "functionMainPage", null);
   add_submenu_page('data_custom', 'addInformations', 'addInformations', 'administrator', 'submenuSlugFistSubMenu', 'submenuTableShow');
   add_submenu_page('data_custom', 'addData', 'addData', 'administrator', 'submenuSlugFistSubMenuTwo', 'addSomeData');


   function functionMainPage()
   {
      global $wpdb;

      if (isset($_GET['removeIt']) && $_GET['removeIt'] == 'remove') {

         $wpdb->delete(
            $wpdb->prefix . 'opp',
            ['customer_id' => $_GET['rmv']],
            ['%d'],
         );
      }




      $data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}opp");

      include WF_data_tpl . 'admin/mainPage.php';
   }

   function submenuTableShow()
   {
      global $wpdb;
      $deviceSamples =  $wpdb->get_results("SELECT * FROM {$wpdb->prefix}dv");
      $genreSamples =  $wpdb->get_results("SELECT * FROM {$wpdb->prefix}gr");
      $p2eSamples =  $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pt");


      //variable
      $deviceString = "";
      $genreString = "";
      $textErea = "";
      $downloadLink = "";
      $gameNames = "";
      $NFT = "";
      $P2e = "";
      $F2P = "";
      $siteAddress = "";
      //add data to dataBase

      if (isset($_POST['saveInformationForm'])) {

         if (isset($_POST['gameName'])) {
            $gameNames = $_POST['gameName'];
         }

         $num =  rand();
         $numAnswer = strval($num);
         $stringAnswer = str_shuffle($gameNames);
         $newfilename = $numAnswer . $stringAnswer;

         if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $tmp= explode('.',  $_FILES['image']['name']);
            $file_ext = end($tmp);
 
            $expensions = array("jpg");
            if (file_exists($file_name)) {
            }
            if (in_array($file_ext, $expensions) === false) {
            }
            if ($file_size > 2097152) {
            }

            if (empty($errors) == true) {
               move_uploaded_file($file_tmp, "images/" . $newfilename . "." . $file_ext);
               echo "<script>window.close();</script>";
            } else {
            }
         }


         if (isset($_POST['textareaPlace'])) {
            $textErea = $_POST['textareaPlace'];
         }

         //add downloadLink
         if (isset($_POST['downloadLink'])) {
            $downloadLink = $_POST['downloadLink'];
         }

         //add NFT
         if (isset($_POST['NFT'])) {
            $NFT = $_POST['NFT'];
         }

         //add f2p
         if (isset($_POST['f2p'])) {
            $F2P = $_POST['f2p'];
         }

         //add p2e
         if (isset($_POST['P2e'])) {
            $P2e = $_POST['P2e'];
         }

         if (isset($_POST['siteAddress'])) {
            $siteAddress = $_POST['siteAddress'];
         }


         //add checkBox data to database
         $arrayInputDevice = array();
         foreach (array_reverse($deviceSamples) as $key => $sample) :

            if (isset($_POST[$sample->divice_name])) {
               if ($_POST[$sample->divice_name] == $sample->divice_name) {
                  array_push($arrayInputDevice, $_POST[$sample->divice_name]);
               }
            }
         endforeach;

         if (isset($arrayInputDevice[0])) {
            $deviceString = $arrayInputDevice[0];
         }
         for ($count = 1; $count < count($arrayInputDevice); $count++) {
            $deviceString = $deviceString . "." . $arrayInputDevice[$count];
         }

         $arrayInputGenre = array();
         foreach (array_reverse($genreSamples) as $key => $sample) :

            if (isset($_POST[$sample->genre_name])) {
               if ($_POST[$sample->genre_name] == $sample->genre_name) {

                  array_push($arrayInputGenre, $_POST[$sample->genre_name]);
               }
            }
         endforeach;

         if (isset($arrayInputGenre[0])) {
            $genreString = $arrayInputGenre[0];
         }
         for ($count = 1; $count < count($arrayInputGenre); $count++) {
            $genreString = $genreString . "." . $arrayInputGenre[$count];
         }
         $data = array(
            'game_name' => $gameNames,
            'download_link' => $downloadLink,
            'genre' => $genreString,
            'Site_address' => $siteAddress,
            'devices' => $deviceString,
            'NFT' => $NFT,
            'P2E' => $P2e,
            'F2P' => $F2P,
            'description' => $textErea,
            'fileName' => $newfilename
         );

         global $wpdb;
         $table = $wpdb->prefix . 'opp';
         $wpdb->insert($table, $data);
         echo "<script>alert('درخواست شما ثبت شد ' )</script>";
      }



      include WF_data_tpl . 'admin/addInformations.php';
   }


   function addSomeData()
   {
      global $wpdb;

      if (isset($_POST['saveDevice'])) {
         $reciverDeviceName = $_POST['deviceName'];
         $data = array(
            'divice_name' => $reciverDeviceName,
         );
         addToDataBase("dv", $data);
      }

      if (isset($_POST['saveGenre'])) {

         $reciverGenreName = $_POST['genreName'];
         $data = array(
            'genre_name' => $reciverGenreName,
         );
         addToDataBase("gr", $data);
      }


      if (isset($_POST['saveP2e'])) {

         $reciverP2e = $_POST['p2eName'];
         $data = array(
            'p2e_name' => $reciverP2e,
         );
         addToDataBase("pt", $data);
      }

      if (isset($_GET['device']) && $_GET['device'] == 'remove') {

         $wpdb->delete(
            $wpdb->prefix . 'dv',
            ['customer_id' => $_GET['deviceRemove']],
            ['%d'],
         );
      }

      if (isset($_GET['genre']) && $_GET['genre'] == 'remove') {

         $wpdb->delete(
            $wpdb->prefix . 'gr',
            ['customer_id' => $_GET['genreRemove']],
            ['%d'],
         );
      }
      if (isset($_GET['p2e']) && $_GET['p2e'] == 'remove') {

         $wpdb->delete(
            $wpdb->prefix . 'pt',
            ['customer_id' => $_GET['p2eRemove']],
            ['%d'],
         );
      }

      $deviceSamples =  $wpdb->get_results("SELECT * FROM {$wpdb->prefix}dv");
      $genreSamples =  $wpdb->get_results("SELECT * FROM {$wpdb->prefix}gr");
      $p2eSamples =  $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pt");

      include WF_data_tpl . 'admin/addData.php';
   }


   function addToDataBase($tablesName, $data)
   {
      global $wpdb;
      $table = $wpdb->prefix . $tablesName;
      $wpdb->insert($table, $data);
      echo "<script>alert('درخواست شما ثبت شد ' )</script>";
      echo '<script>location.reload();</script>';
   }
}
