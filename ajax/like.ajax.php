<?php

// Check if the user is logged in
if (!isset($_SESSION['ekomuniti_userID'])) {
    die;
}

// Parse the query string from the link
$query_string = explode("?", $data->link);
$query_string = end($query_string);
$str = explode("&", $query_string);

// Populate $_GET array


foreach ($str as $value) {
    $value = explode("=", $value);
    $_GET[$value[0]] = $value[1];
}

// Check if 'type' and 'id' parameters are set

$_GET['id'] = addslashes($_GET['id']);
$_GET['type'] = addslashes($_GET['type']);

if (isset($_GET['type']) && isset($_GET['id'])) {
    $post = new Post();

    if (is_numeric($_GET['id'])) {
        $allowed = ['post', 'user', 'comment'];

        if (in_array($_GET['type'], $allowed)) {
            $user_class = new User();
            $post->like_post($_GET['id'], $_GET['type'], $_SESSION['ekomuniti_userID']);

            if ($_GET['type'] == "user") {
                $user_class->follow_user($_GET['id'], $_GET['type'], $_SESSION['ekomuniti_userID']);
            }
        }
    }

    // Read likes
    $likes = $post->get_likes($_GET['id'], $_GET['type']);

    // Create info
    ////////////////////////

    $likes = array();
    $info = "";
    if (isset($_SESSION['ekomuniti_userID'])) {
        $DB = new Database();
        $i_liked = false;

        $sql = "SELECT likes FROM likes WHERE type = 'post' AND contentid = '$_GET[id]' LIMIT 1";
        $result = $DB->read($sql);

        if (is_array($result)) {
            $likes = json_decode($result[0]['likes'], true);
            $user_ids = array_column($likes, "userID");

            if (in_array($_SESSION['ekomuniti_userID'], $user_ids)) {
                $i_liked = true;
            }
        }
    }

   $like_count = count('likes');
    if ($like_count > 0) {
        $info .= "<a id='info_$_GET[id]' href='likes.php?type=post&id=$_GET[id]'>";
        $info .= "<br/>";
        if ($like_count == 1) {
            if ($i_liked) {
                $info .= "<div style='text-align: left;'>You liked this post</div>";
            } else {
                $info .= "<div style='text-align: left;'>1 person liked this post</div>";
            }
        } else {
            if ($i_liked) {
                $text = "others";
                if ($like_count - 1 == 1) {
                    $text = "other";
                }
                $info .= "<div style='text-align: left;'>You and " . ($like_count - 1) . " " . $text . " person liked this post</div>";
            } else {
                $info .= "<div style='text-align: left;'>" . $like_count . " people liked this post</div>";
            }
        }
        $info .= "</a>";
    }

////////////////////////////
    $obj = (object)[];
    $obj->likes = count($likes);
    $obj->action = "like_post";
    $obj->info = $info;
    $obj->id = "info_$_GET[id]";

    echo json_encode($obj);
}