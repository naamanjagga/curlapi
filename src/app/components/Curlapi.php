<?php
  namespace App\Components;

  class Curlapi {
      public function getSearchBook($str){
        $url =  "https://openlibrary.org/search.json?q=$str&mode=ebooks&has_fulltext=true";
        return $response = $this->getApi($url);
      }
      public function getSingleBook($str){
        // $url = "https://openlibrary.org/works/OL308980W/Ramayana_a_Holy_Bible_of_India?edition=ia%3Acu31924073062386&format=json";
        $url = "https://openlibrary.org/api/books?bibkeys=ISBN:$str&jscmd=details&format=json";
        return $response = $this->getApi($url);
    }
    
    
    public function getApi($url){

      $ch = curl_init();   
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );   
      curl_setopt($ch, CURLOPT_URL, $url); 
       
      $res = curl_exec($ch );   
      return json_decode($res, true);
      }
    }
