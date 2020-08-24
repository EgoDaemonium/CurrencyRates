<?php
    define('DB_SERVER', '127.0.0.1');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'exchange');

    $counter = 0;
    $url = 'https://www.bank.lv/vk/ecb_rss.xml';
    $rss = simplexml_load_file($url, null, LIBXML_NOCDATA);

    foreach($rss->channel->item as $item) {
        // $title = (string) $item->title;
        // $link = (string) $item->link;
        $description = (string) $item->description;
        $pubDate = (string) $item->pubDate;
        $realDate = date('yy-m-d', strtotime($pubDate));

        // echo "
        //     Title: $title <br/> 
        //     Link: $link <br/> 
        //     Description: $description <br/> 
        //     Pub Date: $pubDate <br/>
        //     <hr/>
        // ";
        // echo "Description: $description <br/> <hr/>";

        $pieces = explode(" ", $description);
        $arr = array();
        for ($i = 0; $i < count($pieces) - 1; $i+=2) {
            $arr[$pieces[$i]] = $pieces[$i+1];
        }
        addToDB($arr, $realDate);
    }

    echo "Done. Added $counter rows in DB";

    function addToDB ($arr, $date) {
        global $counter;
        $resultCurrency;
        $resultRate;
        $resultDate;

        $sql = "SELECT currency, rate, record_date FROM currency_rates WHERE record_date = '$date'";

        execSql($sql, $arr);

        $sql = "";
        foreach ($arr as $key => $value) {
            execSql("INSERT INTO currency_rates (currency, rate, record_date) VALUES ('$key', $value, '$date'); ");
            // $sql .= "INSERT INTO currency_rates (currency, rate, record_date) VALUES ('$key', $value, '$date'); ";
            $counter++;
        }
    }

    function execSql($sql, &$arr = array()) {
        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        if($stmt = mysqli_prepare($db, $sql)) {
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                /* bind result variables */
                if (!empty($arr)) {
                    mysqli_stmt_bind_result($stmt, $resultCurrency, $resultRate, $resultDate);
                    /* fetch values */
                    while (mysqli_stmt_fetch($stmt)) {
                        // echo "$resultCurrency $resultRate $resultDate <br>";
                        unset($arr[$resultCurrency]);
                    }
                }
            } else {
                echo "Kļūda! Kaut kas nogāja greizi. Lūdzu, pamēģiniet vēlreiz.";
            }
            mysqli_stmt_close($stmt);
        }

        mysqli_close($db);
    }
?>