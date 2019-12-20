<?php
error_reporting(E_ALL ^ E_NOTICE);  
include "twitteroauth.php";

$query = htmlspecialchars($_POST["query"]);

$url = "https://api.twitter.com/1.1/search/tweets.json?q=" . $query . "&count=10&f=live";

$consumer_key = "YVbm3pnZQzGPgNvp2pzAt3Nck";
$consumer_secret = "Gt7zEKkadjZ6SBUS3cbTzOS4rIz7CDt8aZ2eX8Ix1NKcohS4Na";
$access_token = "1728452562-GjdIc4AOUMT54Bziel6NTLfaXajSXkMAdrSGpwN";
$access_token_secret = "8dYeLg62yKLAYfJB2gxwXcK80KAbfQFH7lANuUOhIYE7a";

$twitter = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

$tweets = $twitter->get($url);

echo <<<EOT
    <div class="card mt-5 text-center">
        <div class="card-body">
                <h5>Αναζητήσατε αποτελέσματα για την λέξη:<strong> $query</strong></h5>
                <button class="deletetwitter hometab search radius" type="button">Άλλη αναζήτηση</button>
        <script>    
            $(document).ready(function () {
                $(".deletetwitter").click(function(){
                    $("#app").html("");
                    window.scrollTo({
                        top:0,
                        behavior: 'smooth'
                        });
                        $("input").val("");     
                });
            }); 
        </script>
        </div>
    </div>
EOT;

$i = 0;

foreach ($tweets as $tweet){
    foreach ($tweet as $t){
        $i = $i+1;
        $tun = $t->user->name;
        $tt = $t->text;
        $date = substr($t->created_at, 0, 16);
        if ($i<=10){

    echo <<<EOT
        <div class="card mt-5">
            <div class="card-header">
            <i class="far fa-user"> $tun</i>
            </div>
            <div class="card-body bgcolor">
                <p><u>Tweeted </u>: $tt</p>
            </div>
            <div class="card-footer">
            <i class="far fa-calendar"> $date</i>
            </div>
           
        </div>
    EOT;
        }else{
            break;
        }
            
    }
}
echo <<<EOT
    <div class="card mt-5 text-center">
        <div class="card-body">
                <h5>Φτάσατε στο τέλος των αποτελεσμάτων για την λέξη:<strong> $query</strong></h5>
                <button class="deletetwitter hometab search radius" type="button">Άλλη αναζήτηση</button>
        <script>    
            $(document).ready(function () {
                $(".deletetwitter").click(function(){
                    $("#app").html("");
                    window.scrollTo({
                        top:0,
                        behavior: 'smooth'
                        });
                        $("input").val("");     
                });
            }); 
        </script>
        </div>
    </div>
EOT;

?>