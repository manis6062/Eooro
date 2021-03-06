<?php

function display_star_rating($rating, $mainWrapperClass = null, $starWrapperClass = null) {
    $html = '<div class="startwrapper ' . $mainWrapperClass . '">';

// ADDITION FOR COLOR CODE
    for ($i = 0; $i < $rating; $i++) {
        if ($rating < 2) {
            $html .= '<div class="starwrapperRed ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } elseif ($rating > 1 && $rating < 4) {
            $html .= '<div class="starwrapperYellow ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } else {
            $html .= '<div class="starwrapperGreen ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    }
//
    for ($i = 0; $i < 5 - $rating; $i++) {
        $html .= '<div class="starwrapper white ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
    }
    $html .= '</div>';

    return $html;
}

function displayrating($rating, $mainWrapperClass = null, $starWrapperClass = null) {

    $html = '<div class="startwrapper ' . $mainWrapperClass . '">';

    $ratings = explode('.', $rating);
    $rating = $ratings[0];
    $point = $ratings[1];

    for ($i = 0; $i < $rating; $i++) {
        if ($rating < 2) {
            $html .= '<div class="starwrapperRed ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } elseif ($rating > 1 && $rating < 4) {
            $html .= '<div class="starwrapperYellow ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } else {
            $html .= '<div class="starwrapperGreen ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    }

    if ($point > 0) {
        $per = $point * 10;

        if ($rating < 2) {
            $html .= '<div id="here' . $count . '" class="starwrapper trendingReviews HalfBg HalfBgwidth' . $per . ' HalfBgRed white"><i class="fa fa-star"></i></div>';
        } elseif ($rating > 1 && $rating < 4) {
            $html .= '<div id="here' . $count . '" class="starwrapper trendingReviews HalfBg HalfBgwidth' . $per . ' HalfBgYellow white"><i class="fa fa-star"></i></div>';
        } else {
            $html .= '<div id="here' . $count . '" class="starwrapper trendingReviews HalfBg HalfBgwidth' . $per . ' HalfBgGreen white"><i class="fa fa-star"></i></div>';
        }

        for ($i = 0; $i < 5 - $rating - 1; $i++) {
            $html .= '<div class="starwrapper white ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    } else {

        for ($i = 0; $i < 5 - $rating; $i++) {
            $html .= '<div class="starwrapper white ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    }

    $html .= '</div>';
    return $html;
}

function displayratingsmall($rating, $mainWrapperClass = null, $starWrapperClass = null) {

    $html = '<div class="startwrapper ' . $mainWrapperClass . '">';

    $ratings = explode('.', $rating);
    $rating = $ratings[0];
    $point = $ratings[1];

    for ($i = 0; $i < $rating; $i++) {
        if ($rating < 2) {
            $html .= '<div class="starwrapperRed ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } elseif ($rating > 1 && $rating < 4) {
            $html .= '<div class="starwrapperYellow ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } else {
            $html .= '<div class="starwrapperGreen ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    }

    if ($point > 0) {
        $per = $point * 10;

        if ($rating < 2) {
            $html .= '<div id="here' . $count . '" class="starwrapper trendingReviews HalfBgSmall HalfBgwidth' . $per . ' HalfBgRed white starwrapper3"><i class="fa fa-star"></i></div>';
        } elseif ($rating > 1 && $rating < 4) {
            $html .= '<div id="here' . $count . '" class="starwrapper trendingReviews HalfBgSmall HalfBgwidth' . $per . ' HalfBgYellow white starwrapper3"><i class="fa fa-star"></i></div>';
        } else {
            $html .= '<div id="here' . $count . '" class="starwrapper trendingReviews HalfBgSmall HalfBgwidth' . $per . ' HalfBgGreen white starwrapper3"><i class="fa fa-star"></i></div>';
        }

        for ($i = 0; $i < 5 - $rating - 1; $i++) {
            $html .= '<div class="starwrapper white ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    } else {

        for ($i = 0; $i < 5 - $rating; $i++) {
            $html .= '<div class="starwrapper white ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    }

    $html .= '</div>';
    return $html;
}

function displayratingtiny($rating) {

    $html = '<div class="startwrappertiny">';

    $ratings = explode('.', $rating);
    $rating = $ratings[0];
    $point = $ratings[1];

    for ($i = 0; $i < $rating; $i++) {
        if ($rating < 2) {
            $html .= '<div class="starwrapperRed ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } elseif ($rating > 1 && $rating < 4) {
            $html .= '<div class="starwrapperYellow ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } else {
            $html .= '<div class="starwrapperGreen ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    }

    if ($point > 0) {
        $per = $point * 10;

        if ($rating < 2) {
            $html .= '<div id="here' . $count . '" class="starwrapper trendingReviews HalfBgSmall HalfBgwidth' . $per . ' HalfBgRed white starwrapper3"><i class="fa fa-star"></i></div>';
        } elseif ($rating > 1 && $rating < 4) {
            $html .= '<div id="here' . $count . '" class="starwrapper trendingReviews HalfBgSmall HalfBgwidth' . $per . ' HalfBgYellow white starwrapper3"><i class="fa fa-star"></i></div>';
        } else {
            $html .= '<div id="here' . $count . '" class="starwrapper trendingReviews HalfBgSmall HalfBgwidth' . $per . ' HalfBgGreen white starwrapper3"><i class="fa fa-star"></i></div>';
        }

        for ($i = 0; $i < 5 - $rating - 1; $i++) {
            $html .= '<div class="starwrapper white ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    } else {

        for ($i = 0; $i < 5 - $rating; $i++) {
            $html .= '<div class="starwrapper white ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    }

    $html .= '</div>';

    $html .="<style>";

    $html .="
    .starwrapperRed, .white, .starwrapperYellow, .starwrapperGreen, .HalfBgSmall, .HalfBgRed, .HalfBgYellow , .HalfBgGreen, .HalfBgwidth50 , .starwrapper, .starwrapper3, .trendingReviews{
        line-height: 20px !important;
        margin-right: 5px !important;
        height: 20px !important;
        width: 19px !important;
    }

    .HalfBgSmall::before{
        max-height: 20px !important;
    }
    ";

    $html .= "</style>";
    return $html;
}

function get_listing_thumb_id($listing_id) {
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    $sql = "SELECT thumb_id FROM {$dbDomain->db_name}.Listing Where id = $listing_id";

    $resource = $dbDomain->query($sql);
    $array = mysql_fetch_array($resource);
    return $array['thumb_id'];
}

function get_business_id($listing_id) {
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    $sql = "SELECT custom_dropdown5 FROM {$dbDomain->db_name}.Listing Where id = $listing_id";

    $resource = $dbDomain->query($sql);
    $array = mysql_fetch_array($resource);
    return $array['custom_dropdown5'];
}

function display_star_rating_dashboard($rating, $mainWrapperClass = null, $starWrapperClass = null) {
    $html = '<div class="startwrapper ' . $mainWrapperClass . '">';

    // ORIGINAL CODE
    // for( $i = 0; $i < $rating; $i++ ) {
    //     $html .= '<div class="starwrapper '.$starWrapperClass.'"><i class="fa fa-star"></i></div>';
    // }
// ADDITION FOR COLOR CODE
    for ($i = 0; $i < $rating; $i++) {
        if ($rating < 2) {
            $html .= '<div class="starwrapperRed ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } elseif ($rating > 1 && $rating < 4) {
            $html .= '<div class="starwrapperYellow ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        } else {
            $html .= '<div class="starwrapperGreen ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
        }
    }
//
    for ($i = 0; $i < 5 - $rating; $i++) {
        $html .= '<div class="starwrapper white ' . $starWrapperClass . '"><i class="fa fa-star"></i></div>';
    }
    $html .= '</div>';

    return $html;
}


function checkExpiredImage($image_url) {
    //Check if the url signature is expired 
    $url = $image_url;
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            echo curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

    $lines_string = curl_exec($ch);
    curl_close($ch);

    return $lines_string;
}

function getImageUrl($review) {
    if ($review['facebook_image']) {

        //Check if the url signature is expired 
        if (checkExpiredImage($review['facebook_image']) == "URL signature expired" || checkExpiredImage($review['facebook_image']) == "Content not found") {
            $facebookImage = DEFAULT_URL . "/images/profile_noimage.png";
        } else {
            $facebookImage = $review['facebook_image'];
            if (HTTPS_MODE == "on") {
                $facebookImage = str_replace("http://", "https://", $review['facebook_image']);
            }
            return $facebookImage;
        }
        return $facebookImage;
    } else {

        if ($review['image']) {
            $explodedReview = explode('src="', $review['image']);
            $string = $explodedReview[1];
            $return = explode('"', $string)[0];

            if ($return) {
                return $return;
            } else {
                return DEFAULT_URL . '/images/profile_noimage.png';
            }
        } else {
            return DEFAULT_URL . '/images/profile_noimage.png';
        }
    }
}

function getSocialButtons() {
    $buttons = '<ul class="social detailSocial">
                    <li>
                        <a href="#" class="bg">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tw bg">
                            <i class="fa fa-twitter"></i>
                        </a>
                     </li>
                    <li>
                        <a href="#" class="heart">
                            <i class="fa fa-heart"></i>
                        </a>
                     </li>
                    <li>
                        <a href="#" class="phone">
                            <i class="fa fa-phone"></i>
                        </a>
                     </li>
                    <li>
                        <a href="#">
                            <span class="fa-stack comment">
                                <i class="fa fa-comment customComment"></i>
                                <strong class="fa-stack-1x">SMS</strong>
                            </span>
                        </a>
                     </li>
                </ul>';

    return $buttons;
}

function escape_bad_things($variable) {

    if (is_array($variable)) {

        foreach ($variable as $variabl) {
            $variables[] = htmlentities($variabl);
        }
    } else {

        $variables = htmlentities($variable);
    }
    return $variables;
}

function escape_bad_things2($variable) {

    if (is_array($variable)) {
        foreach ($variable as $variabl) {
            $variables[] = mysql_real_escape_string($variabl);
        }
    } else {
        $variables = mysql_real_escape_string($variable);
    }

    return $variables;
}

function concat($string, $delimiter = 20) {
    $length = strlen($string);
    $return = ($length > $delimiter ? substr($string, 0, $delimiter) . "..." : $string);
    return $return;
}

function redirectTo() {
    $default = DEFAULT_URL . "/" . MEMBERS_ALIAS . "/listing/addsearchlisting.php";
    if (!empty($_SERVER['REQUEST_URI'])) {

        if (!empty($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'advertise.php')) {
            return $default;
        }
        return $_SERVER['REQUEST_URI'];
    }
    // if server referer / redirect uri not found.
    return $default;
}

if ($_POST['captchaResponse']) {
    $captcha = filter_input(INPUT_POST, 'captchaResponse'); // get the captchaResponse parameter sent from our ajax
    /* Check if captcha is filled */

    if (!$captcha) {
        http_response_code(401); // Return error code if there is no captcha
    }
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . DATA_SECRETKEY . "&response=" . $captcha);
    if ($response . success == false) {
        echo 'SPAM';
        http_response_code(401); // It's SPAM! RETURN SOME KIND OF ERROR
    } else {
        echo 'EVERYTHING LOOKS FINE';
        // Everything is ok and you can proceed by executing your login, signup, update etc scripts
    }
    exit;
}
