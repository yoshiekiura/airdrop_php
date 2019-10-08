<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Home Controller
 * Management all actions before login.
 * 
 * @author yakov
 */


if (!function_exists('campaign_data')) {

    define("C_TABS", array(
        "Telegram",
        "Twitter",
        "Facebook",
        "Reddit",
        "LinkedIn",
        "Bitcointalk",
		"Medium",
		"WritingArticles"
    ));
    /**
     * score: 
     * text:
     * url:
     * count: if canRepeat is true, this is max count in daily.
     *          if not, this value is not used.
     * canRepeat: can submit over twices.
     * comment: can show comment
     */
    define("C_DATA", array(
        array(
            "tab_id"=> 0,
            "score" => 10,
            "text"  => "Join our Telegram group",
            "url"   => "https://t.me/SocialRemit",
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Join Us",
            "placeholder" => "Please enter your Telegram ID here."
        ),
        array(
            "tab_id"=> 1,
            'score'=>10,
            'text'=>'Follow us on Twitter',
            'url'=>'https://twitter.com/Socialremit_uk',
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Follow Us",
            "placeholder" => "Please enter your Twitter ID here."
        ),
        array(
            "tab_id"=> 1,
            'score'=>5,
            'text'=>'Like and Retweet',
            'url'=>'https://twitter.com/Socialremit_uk',
            "count" => 8,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Visit",
            "placeholder" => "Please share the link here."
        ),
        array(
            "tab_id"=> 2,
            'score'=>10,
            'text'=>'Like us on facebook',
            'url'=>'https://www.facebook.com/SocialRemit-Blockchain-Networks-LTD-225736334625445/',
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Like Us",
            "placeholder" => "Please enter your facebook ID here."
        ),
        array(
            "tab_id"=> 2,
            'score'=>5,
            'text'=>'Share our posts on facebook',
            'url'=>'https://www.facebook.com/SocialRemit-Blockchain-Networks-LTD-225736334625445/',
            "count" => 8,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Visit",
            "placeholder" => "Please share the link here."
        ),
        array(
            "tab_id"=> 3,
            'score'=>10,
            'text'=>'Subscribe our Reddit account',
            'url'=>'https://www.reddit.com/user/socialremit',
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Visit",
            "placeholder" => "Please enter your Reddit ID here."
        ),
        array(
            "tab_id"=> 3,
            'id'=>6,
            'score'=>5,
            'text'=>'Comment and upvote our Reddit post',
            'url'=>'https://www.reddit.com/user/socialremit/posts/',
            "count" => 8,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Visit",
            "placeholder" => "Please share the link here."
        ),
        array(
            "tab_id"=> 4,
            'score'=>10,
            'text'=>'Follow us on LikedIn',
            'url'=>'https://www.linkedin.com/company/SocialRemit/',
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Follow Us",
            "placeholder" => "Please enter your LikedIn ID here."
        ),
        array(
            "tab_id"=> 5,
            'score'=>5,
            'text'=>'Comment our Bitcointalk',
            'url'=>'https://bitcointalk.org/index.php?topic=4471416',
            "count" => 8,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Visit",
            "placeholder" => "Please share the link here."
        ),
        array(
            "tab_id"=> 6,
            'score'=>10,
            'text'=>'Follow us on Medium',
            'url'=>'https://medium.com/@SocialRemit',
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "Follow Us",
            "placeholder" => "Please enter your Medium ID here."
		),
        array(
            "tab_id"=> 7,
            'score'=>10,
            'text'=>'Post cool blogs and vlogs about our project and get bigger reward!',
            'url'=>'',
            "count" => 8,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "",
            "placeholder" => "Detailed description of your work.\nDo not put retweet link here."
        ),
        
        array(
            "tab_id"=> 0,
            "score" => 10,
            "text"  => "Change your Telegram profile picture to SocialRemit Logo",
            "url"   => "https://www.socialremit.com/asset/img/SocialRemit_Logo.png",
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "",
            "placeholder" => "Please enter your Telegram profile link here."
        ),
        array(
            "tab_id"=> 1,
            "score" => 10,
            "text"  => "Change your Twitter profile picture to SocialRemit Logo",
            "url"   => "https://www.socialremit.com/asset/img/SocialRemit_Logo.png",
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "",
            "placeholder" => "Please enter your Twitter profile link here."
        ),
        array(
            "tab_id"=> 2,
            "score" => 10,
            "text"  => "Change your Facebook profile picture to SocialRemit Logo",
            "url"   => "https://www.socialremit.com/asset/img/SocialRemit_Logo.png",
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "",
            "placeholder" => "Please enter your Facebook profile link here."
        ),
        array(
            "tab_id"=> 3,
            "score" => 10,
            "text"  => "Change your Reddit profile picture to SocialRemit Logo",
            "url"   => "https://www.socialremit.com/asset/img/SocialRemit_Logo.png",
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "",
            "placeholder" => "Please enter your Reddit profile link here."
        ),
        array(
            "tab_id"=> 4,
            "score" => 10,
            "text"  => "Change your LinkedIn profile picture to SocialRemit Logo",
            "url"   => "https://www.socialremit.com/asset/img/SocialRemit_Logo.png",
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "",
            "placeholder" => "Please enter your LinkedIn profile link here."
        ),
        array(
            "tab_id"=> 5,
            "score" => 10,
            "text"  => "Change your Bitcointalk profile picture to SocialRemit Logo",
            "url"   => "https://www.socialremit.com/asset/img/SocialRemit_Logo.png",
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "",
            "placeholder" => "Please enter your Bitcointalk profile link here."
        ),
        array(
            "tab_id"=> 6,
            "score" => 10,
            "text"  => "Change your Medium profile picture to SocialRemit Logo",
            "url"   => "https://www.socialremit.com/asset/img/SocialRemit_Logo.png",
            "count" => 1,
            "canRepeat" => false,
            "comment"   => true,
            "btntext" => "",
            "placeholder" => "Please enter your Medium profile link here."
        )
    ));

    function getCampaignTab() {
        return C_TABS;
    }
    function getCampaignData() {
        return C_DATA;
    }

    function getCampaignTextWithId($id) {
        return C_DATA [$id]["text"];
    }

    function getCampaignCountDesc($count, $canRepeat) {
        if ($canRepeat)
            return "You can do this $count times every day.";
        else if ($count != 1) 
            return "You can do this up to $count times during whole Airdrop period.";
        else
            return "One Time.";
    }
}
