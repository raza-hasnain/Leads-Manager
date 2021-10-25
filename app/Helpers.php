<?php

    function generateRandomStr($length = 8) {
        $UpperStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $LowerStr = "abcdefghijklmnopqrstuvwxyz";
        $numbers = "0123456789";
        $symbols = "$*_-";
        $characters = $numbers.$symbols.$LowerStr.$UpperStr;
        $charactersLength = strlen($characters);
        $randomStr = null;
        for ($i = 0; $i < $length; $i++) {
            $randomStr .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomStr;
    }

    function getcountry($country_name = null,$country_code = null) {
        if ($country_name == null && $country_code == null) {
            return null;
        }elseif ($country_name != null) {
            $country = App\Models\Country::getcountryby_name($country_name);
            return $country;
        }else{
           $country = App\Models\Country::getcountryby_code($country_code);
           return $country;
        }

    }

function get_option($res,$value_field,$text_field_loc, $selected ="") {
 
    $text_field=$text_field_loc;
    $code = "";
    if($res==null || $res=='')
        return $code;
    if(is_array($res)){
        foreach($res as $key=>$row) {
            if((string)$selected == (string)$key)
                $code .= "<option selected='selected' value='". $key ."'>"."\t".clean($row)."</option>";
            else
                $code .= "<option value='". $key ."'>".clean($row)."</option>";
        }  
    }else{
        foreach($res as $row) {
            if((string)$selected == (string)$row->$value_field)
                $code .= "<option selected='selected' value='". $row->$value_field ."'>"."\t".clean($row->$text_field)."</option>";
            else
                $code .= "<option value='". $row->$value_field ."'>".clean($row->$text_field)."</option>";
        }
    }
    return $code;
}


function countStatus($objectarray,$coloum)
{
    $plucked = $objectarray->pluck($coloum)->toArray();
    $countstatus = array_count_values($plucked);
    return $countstatus;
}
function numbersofstatus($array,$id){
     if(array_key_exists($id,$array)){
                    $number = $array[$id];
                    return $number;
                }

        else{
                    $number = 0;
                    return $number;
                    }
}

function activeMenu($url){

    if($url==URL::current()){
        echo "active";
    }
}

function img_process($img,$path){
            try{ 
          if($img != null ){ 
               $imageDir = storage_path($path);
         $data = explode(',', $img );
          $milli = round(microtime(true) * 1000);
           $value = base64_decode($data[1]);
      $ext = "";
       $source_img = imagecreatefromstring($value);
      if($data[0] == "data:image/png;base64" ){
        $ext = "png";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagepng($source_img, $output_file, 9);
      }
     
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagejpeg($source_img, $output_file, 100);
      }
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagejpeg($source_img, $output_file, 100);
      }
       elseif($data[0] == "data:image/gif;base64" ){
        $ext = "gif";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagegif($source_img, $output_file, 100);
      }
      else
      {

        exit;
      }
    
        imagedestroy($source_img);
        file_put_contents($output_file, $value);
        $array = [];
        $array[0]= $milli;
        $array[1]= $ext;
        return $array;
}
else{
    return false;
}
}
  catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }
    }
    
    function display_menu($menuName,$isSuperAdmin=false){

    return \App\Models\Menu::display($menuName,$isSuperAdmin);
}

function changeEnv($data){
       
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);
            
            return true;
        } else {
            return false;
        }
    }

    function anchor_link($main_text, $link, $newTab = NULL, $permission = NULL)
{
    $newTab = (isset($newTab) && $newTab == TRUE) ? 'target="_blank"' : '';
    return ' <a '.$newTab.' class="" href="'.$link.'">'.$main_text.'</a>';
}

function log_activity($performedOn, $description, $value_to_save = NULL, $log_name = NULL)
{
    $activity = activity($log_name)
    ->performedOn($performedOn)
   ->causedBy(auth()->user())
   ->withProperties(['item' => $value_to_save])       
   ->log($description)
   ;


}


function imgbase64($filename){
    $value =explode("/",$filename);
    $filedata = storage_path('app/public/'.$value[1].'/'.$value[2]);

    $encoded_data = base64_encode(file_get_contents($filedata));
    return $encoded_data;
}

function removeScript($data){
     $word = "script";
    $mystring = $data;
 
// Test if string contains the word 
        if(strpos($mystring, $word) !== false){
             $data = str_replace($word,"remove",$mystring);
        }
        return $data;
}

function removeWhite($mystring){
    $word=" ";
    if(strpos($mystring, $word) !== false){
             $value = str_replace($word,"",$mystring);
             return $value;
        } 
        return $mystring;
}

function backgrountprocess($img,$path,$name){
       try{ 
          if($img != null ){ 
               $imageDir = storage_path($path);
         $data = explode(',', $img );
          $milli = $name;
           $value = base64_decode($data[1]);
      $ext = "";
       $source_img = imagecreatefromstring($value);
      if($data[0] == "data:image/png;base64" ){
        $ext = "png";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagepng($source_img, $output_file, 9);
      }
     
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagejpeg($source_img, $output_file, 100);
      }
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagejpeg($source_img, $output_file, 100);
      }
       elseif($data[0] == "data:image/gif;base64" ){
        $ext = "gif";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagegif($source_img, $output_file, 100);
      }
      else
      {

        exit;
      }
    
        imagedestroy($source_img);
        file_put_contents($output_file, $value);
        $array = [];
        $array[0]= $milli;
        $array[1]= $ext;
        return $array;
}
else{
    return false;
}
}
  catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }
}

?>