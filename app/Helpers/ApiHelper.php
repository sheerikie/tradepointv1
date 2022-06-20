<?php

namespace App\Helpers;

use \GuzzleHttp\Client;

/*
 * Hacker News Helper
 * implementa ações sobre a Hacker News API
 * ref.: https://github.com/HackerNews/API
 */
class ApiHelper
{
    public static $base = "https://hacker-news.firebaseio.com/v0/";

    public static function makeRequest($resource)
    {
        $client = new Client();
        $url = self::$base.$resource.".json?print=pretty";
        $request = $client->get($url);
        $response = json_decode($request->getBody()->getContents());
        return $response;
    }

    public static function getStoriesFromList($list, $limit=10)
    {
        $stories = collect([]);
        $contagem = 0;
        foreach ($list as $id) {
            $item = self::getItem($id);
            if ($item) {
                if ($item->type == "story") {
                    $stories->push($item);
                    $contagem++;
                }
            }
            if ($contagem >= $limit) {
                break;
            }
        }
        return $stories;
    }

    /**
     * Return a item based on $id param.
     *
     * @param $id
     * @return null|json
     */
    public static function getItem($id)
    {
        $resource = "item/".$id;
        return self::makeRequest($resource);
    }

    public static function getTopStories($limit=25)
    {
        $resource = "topstories";
        $response = self::makeRequest($resource);
        $stories = self::getStoriesFromList($response, $limit);
        
        return $stories;
    }

    public static function getLastUserStories($limit=600)
    {
        $resource = "newstories";
        $response = self::makeRequest($resource);

        $stories = self::getStoriesFromList($response, $limit);
    
        $stop_words = [];
        $repeatedwords=[];
   
        for ($i=0;$i<count($stories);$i++) {
            $user = self::getUserStories($stories[$i]->by, $limit);
  
            if ($user->karma > 10) {
                $title = strtolower($stories[$i]->title); // Make string lowercase
             
                $words = str_word_count($title, 1); // Returns an array containing all the words found inside the string
            
                $words = array_diff($words, $stop_words); // Remove black-list words from the array
            $words = array_count_values($words); // Count the number of occurrence
        
            arsort($words); // Sort based on count
                array_push($repeatedwords, array_slice($words, 0, $limit));
            }
        }

    
        return $repeatedwords;
    }

    public static function getMostOccuringWords($string, $type)
    {
        $stop_words = [];
        $repeatedwords=[];
        foreach ($string as $key=>$item) {
            $limit=10;
      
            if ($type='lastweek' && $item->time > strtotime("-1 week")) {
                $title = strtolower($item->title); // Make string lowercase
            }
            if ($type='other') {
                $title = strtolower($item->title); // Make string lowercase
            }
            
            $words = str_word_count($title, 1); // Returns an array containing all the words found inside the string
            $words = array_diff($words, $stop_words); // Remove black-list words from the array
            $words = array_count_values($words); // Count the number of occurrence
        
            arsort($words); // Sort based on count
            array_push($repeatedwords, array_slice($words, 0, $limit));
        }
        return $repeatedwords;
    }
    public static function getLastWeekData($limit=25)
    {
        $resource = "newstories";
        $response = self::makeRequest($resource);
        $stories = self::getStoriesFromList($response, $limit);
        $occWords = self::getMostOccuringWords($stories, $type='lastweek');
      
        return $occWords;
   
        // return $occWords;
    }
    public static function getLastStories($limit=25)
    {
        $resource = "newstories";
        $response = self::makeRequest($resource);
        $stories = self::getStoriesFromList($response, $limit);
        $occWords = self::getMostOccuringWords($stories, $type='other');
        return $occWords;
    }
    
    
    public static function getNewStories($limit=25)
    {
        $resource = "newstories";
        $response = self::makeRequest($resource);
        $stories = self::getStoriesFromList($response, $limit);
        return $stories;
    }

    public static function getBestStories($limit=10)
    {
        $resource = "beststories";
        $response = self::makeRequest($resource);
        $stories = self::getStoriesFromList($response, $limit);
        return $stories;
    }

    public static function getUserWithStories($id, $limit=1)
    {
        $resource = "user/".$id;
        $user = self::makeRequest($resource);
        if ($user) {
            if ($user->submitted) {
                $user->stories = self::getStoriesFromList($user->submitted, $limit);
            }
        }
        return $user;
    }
    public static function getUserStories($id, $limit=1)
    {
        $resource = "user/".$id;
        $user = self::makeRequest($resource);
        return $user;
    }
}
