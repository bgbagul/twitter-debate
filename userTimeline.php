<?php
// PHP Wrapper for Twitter's User_Timeline function
// By Christopher Blair
class Timeline
{
    static function getUserTimeline($user) {
        $searchUrl .= "https://api.twitter.com/1/statuses/user_timeline.json?&screen_name=";
        $searchUrl .= "$user";
        $searchUrl .= "&count=200";
        $searchString = file_get_contents($searchUrl);
        $jsonSearch = json_decode($searchString);
        return $jsonSearch;
    }
}
?>