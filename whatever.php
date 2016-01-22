<?php
//database schema used
//create database queue;
//grant all on queue.* to queue@localhost identified by 'password'
//create table `queue`.`queue`(
//   `id` int(11) NOT NULL AUTO_INCREMENT ,
//   `status` int(1) NOT NULL ,
//   `html` varchar(255) NOT NULL ,
//   PRIMARY KEY (`id`)
// )
function add_to_queue($command) {
        if (!isset($command)) {
                die("No command!");
        }
        if ($link = mysqli_connect("localhost", "queue", "password", "queue")) {
                echo "connected to mysql<br>";
                $cmd = mysqli_real_escape_string($link, $command);
                $q = mysqli_query($link, "INSERT into queue VALUES (NULL, 0, '$cmd')") or die(mysqli_error($link));
                mysqli_close($link);
                echo "Command $command added to the queue!";
        } else {
                echo "cannot connect to database!";
        }
}
if (isset($_GET['a'])) {
        $add = $_GET['a'];
        add_to_queue($add);
        //add this event to the queue
} else {
        //run something from the queue
        if ($link = mysqli_connect("localhost", "queue", "password", "queue")) {
                $q = mysqli_query($link, "SELECT * from queue.queue where status = 0 ORDER BY id asc limit 1");
                if ($q) {
                        $rows = mysqli_num_rows($q);
                        if ($rows > 0) {
                                $row = mysqli_fetch_row($q);
                                $id = $row[0];
                                $html = $row[2];
                                $u_q = mysqli_query($link, "UPDATE queue.queue SET status = 1 where id = $id limit 1");
                        }
                }
        }
}
if (!isset($html))
exit;
?>
<html>
        <head>
                <title>My Stream Animated Panels</title>
                <meta http-equiv="refresh" content="60">
                <style>
                        @font-face {
                                font-family: 'Dolce Vita';
                                src: url('fonts/Dolce Vita.ttf');
                                }
                        #reminderContainer {
                                width: 0px;
                                height: 0px;
                                background: #2e5794;
                                position: absolute;
                                top: 0px;
                                left: 0px;
                                overflow: hidden;
                                color: white;
                                font-family: 'Dolce Vita';
                                -webkit-box-shadow: 0px 0px 20px #0f3369;
                                -webkit-animation: animateReminder 10s 0s 1;
                                }
                        #reminderHeader {
                                width: 400px;
                                height: 26px;
                                background: #0f3369;
                                position: relative;
                                overflow: hidden;
                                text-align: center;
                                font-size: 24px;
                                }
                        #reminderContent {
                                width: 400px;
                                height: 94px;
                                background: #2e5794;
                                position: relative;
                                overflow: hidden;
                                color: white;
                                }
                        #twitchLogo {
                                width: 90px;
                                height: 90px;
                                float: left;
                                }

                        @-webkit-keyframes animateReminder {
                                0%, 100% {
                                        width: 0px;
                                        height: 24px;
                                        }
                                20%, 80% {
                                        width: 400px;
                                        height: 24px;
                                        }
                                30%, 70% {
                                        width: 400px;
                                        height: 120px;
                                        }
                                }
                </style>
        </head>
        <body>
                <div id="reminderContainer">
                        <div id="reminderHeader"><span><?php echo $html; ?></span></div>
                        <div="reminderContentText"><span><?php echo $html; ?></span></div>
               </div>
        </div>
                </div>
        </body>
</html>
