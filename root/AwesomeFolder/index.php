<html>
    <head>
        <title>Welcome to your SWAG instance</title>
        <style type="text/css">
        body{
            font-family: Helvetica, Arial, sans-serif;
        }
        .message{
            width:440px;
            padding:20px 40px;
            margin:0 auto;
            background-color:#f9f9f9;
            border:1px solid #ddd;
            color: #1e3d62;
        }
        center{
            margin:40px 0;
        }
        h1{
            font-size: 18px;
            line-height: 26px;
        }
        p{
            font-size: 12px;
        }
        a{
            color: rgb(207, 48, 139);
        }
        thead {
            font-weight: bold;
        }
        td {
            padding: 3px;
            color: #1e3d62;
        }
        .align-td {
            text-align: center;
        }
        .circle-text {
            padding: 0px 5px;
            color: #fff;
        }
        .circle-empty {
            padding: 0px 10px;
        }
        .green-circle {
            border-radius: 100%;
            background-color: green;
            border: 1px solid black;
        }
        .red-circle {
            padding: 0px 10px;
            border-radius: 50%;
            background-color: red;
            border: 1px solid black;
        }
        .tooltip {
            position: relative;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            white-space: nowrap;
            background-color: black;
            color: #fff;
            text-align: left;
            border-radius: 6px;
            padding: 15px;
            position: absolute;
            z-index: 1;
            top: -35px;
            left: 100%;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 50%;
            right: 100%;
            margin-top: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent black transparent transparent;
        }
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
        </style>
    </head>
    <body>
        <div class="message">
            <h1>Welcome to your <a target="_blank" href="https://github.com/linuxserver/docker-swag">SWAG</a> instance</h1>
            <p>A webserver and reverse proxy solution brought to you by <a target="_blank" href="https://www.linuxserver.io/">linuxserver.io</a> with php support and a built-in Certbot client.</p>
            <p>We have an article on how to use swag here: <a target="_blank" href="https://docs.linuxserver.io/general/swag">docs.linuxserver.io</a></p>
            <p>For help and support, please visit: <a target="_blank" href="https://www.linuxserver.io/support">linuxserver.io/support</a></p>
            <p>
                <table>
                    <col style="width:70%">
                    <col style="width:15%">
                    <col style="width:15%">
                    <thead>
                    <tr>
                        <td>Application</td>
                        <td>Available</td>
                        <td>Proxied</td>
                    </tr>
                    </thead>
                    <?php
                        $output = shell_exec("python3 /config/swag-status/swag-status.py");
                        $results = json_decode($output);
                        foreach($results as $result => $data){
                    ?>
                    <tr>
                        <td>
                            <?php echo $result;?>
                        </td>
                        <td class="align-td">
                            <?php if ($data->status == 1) { ?>
                            <span class="green-circle circle-empty"></span>
                            <?php } else { ?>
                            <span class="red-circle"></span>
                            <?php } ?>
                        </td>
                        <td class="tooltip align-td">
                            <?php if (!empty($data->locations)) { ?>
                            <span class="green-circle circle-text">?</span>
                            <span class="tooltiptext">
                                Locations:
                                <ol>
                                    <?php 
                                    foreach ($data->locations as $location) {
                                        echo "<li>$location</li>";
                                    } 
                                    ?>
                                </ol>
                            </span>
                            <?php } else { ?>
                            <span class="red-circle"></span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </p>
        </div>
    </body>
</html>