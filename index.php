<?php
echo '<p>REQUEST_URI: ' . $_SERVER['REQUEST_URI'] . '</p>';
echo '<p>PHP_SELF: ' . $_SERVER['PHP_SELF'] . '</p>';
echo '<p>SCRIPT_NAME: ' . $_SERVER['SCRIPT_NAME'] . '</p>';
echo '<p>SCRIPT_FILENAME: ' . $_SERVER['SCRIPT_FILENAME'] . '</p> </br> </br>';

$dir = './';
$files = scandir($dir, 1);

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>listing directory <?= $dir ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            outline: 0;
        }

        body {
            padding: 80px 100px;
            font: 13px "Helvetica Neue", "Lucida Grande", "Arial";
            background: #ECE9E9 -webkit-gradient(linear, 0% 0%, 0% 100%, from(#fff), to(#ECE9E9));
            background: #ECE9E9 -moz-linear-gradient(top, #fff, #ECE9E9);
            background-repeat: no-repeat;
            color: #555;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3 {
            font-size: 22px;
            color: #343434;
        }

        h1 em,
        h2 em {
            padding: 0 5px;
            font-weight: normal;
        }

        h1 {
            font-size: 60px;
        }

        h2 {
            margin-top: 10px;
        }

        h3 {
            margin: 5px 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
            font-size: 18px;
        }

        ul li {
            list-style: none;
        }

        ul li:hover {
            cursor: pointer;
            color: #2e2e2e;
        }

        ul li .path {
            padding-left: 5px;
            font-weight: bold;
        }

        ul li .line {
            padding-right: 5px;
            font-style: italic;
        }

        ul li:first-child .path {
            padding-left: 0;
        }

        p {
            line-height: 1.5;
        }

        a {
            color: #555;
            text-decoration: none;
        }

        a:hover {
            color: #303030;
        }

        #stacktrace {
            margin-top: 15px;
        }

        .directory h1 {
            margin-bottom: 15px;
            font-size: 18px;
        }

        ul#files {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        ul#files li {
            float: left;
            width: 30%;
            line-height: 25px;
            margin: 1px;
        }

        ul#files li a {
            display: block;
            height: 25px;
            border: 1px solid transparent;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            overflow: hidden;
            white-space: nowrap;
        }

        ul#files li a:focus,
        ul#files li a:hover {
            background: rgba(255, 255, 255, 0.65);
            border: 1px solid #ececec;
        }

        ul#files li a.highlight {
            -webkit-transition: background .4s ease-in-out;
            background: #ffff4f;
            border-color: #E9DC51;
        }

        #search {
            display: block;
            position: relative;
            top: 20px;
            right: 20px;
            width: 90px;
            -webkit-transition: width ease 0.2s, opacity ease 0.4s;
            -moz-transition: width ease 0.2s, opacity ease 0.4s;
            -webkit-border-radius: 32px;
            -moz-border-radius: 32px;
            -webkit-box-shadow: inset 0px 0px 3px rgba(0, 0, 0, 0.25), inset 0px 1px 3px rgba(0, 0, 0, 0.7), 0px 1px 0px rgba(255, 255, 255, 0.03);
            -moz-box-shadow: inset 0px 0px 3px rgba(0, 0, 0, 0.25), inset 0px 1px 3px rgba(0, 0, 0, 0.7), 0px 1px 0px rgba(255, 255, 255, 0.03);
            -webkit-font-smoothing: antialiased;
            text-align: left;
            font: 13px "Helvetica Neue", Arial, sans-serif;
            padding: 4px 10px;
            border: none;
            background: transparent;
            margin-bottom: 50;
            outline: none;
            opacity: 0.7;
            color: #888;
        }

        #search:focus {
            width: 120px;
            opacity: 1.0;
        }

        /*views*/
        #files span {
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            text-indent: 10px;
        }

        #files .name {
            background-repeat: no-repeat;
        }

        #files .icon .name {
            text-indent: 28px;
        }

        /*tiles*/
        .view-tiles .name {
            width: 100%;
            background-position: 8px 5px;
        }

        .view-tiles .size,
        .view-tiles .date {
            display: none;
        }

        /*details*/
        ul#files.view-details li {
            float: none;
            display: block;
            width: 90%;
        }

        ul#files.view-details li.header {
            height: 25px;
            background: #000;
            color: #fff;
            font-weight: bold;
        }

        .view-details .header {
            border-radius: 5px;
        }

        .view-details .name {
            width: 60%;
            background-position: 8px 5px;
        }

        .view-details .size {
            width: 10%;
        }

        .view-details .date {
            width: 30%;
        }

        .view-details .size,
        .view-details .date {
            text-align: right;
            direction: rtl;
        }

        /*mobile*/
        @media (max-width: 768px) {
            body {
                font-size: 13px;
                line-height: 16px;
                padding: 0;
            }

            #search {
                position: static;
                width: 100%;
                font-size: 2em;
                line-height: 1.8em;
                text-indent: 10px;
                border: 0;
                border-radius: 0;
                padding: 10px 0;
                margin: 0;
            }

            #search:focus {
                width: 100%;
                border: 0;
                opacity: 1;
            }

            .directory h1 {
                font-size: 2em;
                line-height: 1.5em;
                color: #fff;
                background: #000;
                padding: 15px 10px;
                margin: 0;
            }

            ul#files {
                border-top: 1px solid #cacaca;
            }

            ul#files li {
                float: none;
                width: auto !important;
                display: block;
                border-bottom: 1px solid #cacaca;
                font-size: 2em;
                line-height: 1.2em;
                text-indent: 0;
                margin: 0;
            }

            ul#files li:nth-child(odd) {
                background: #e0e0e0;
            }

            ul#files li a {
                height: auto;
                border: 0;
                border-radius: 0;
                padding: 15px 10px;
            }

            ul#files li a:focus,
            ul#files li a:hover {
                border: 0;
            }

            #files .header,
            #files .size,
            #files .date {
                display: none !important;
            }

            #files .name {
                float: none;
                display: inline-block;
                width: 100%;
                text-indent: 0;
                background-position: 0 50%;
            }

            #files .icon .name {
                text-indent: 41px;
            }
        }

        #files .icon-txt .name {
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAADoSURBVBgZBcExblNBGAbA2ceegTRBuIKOgiihSZNTcC5LUHAihNJR0kGKCDcYJY6D3/77MdOinTvzAgCw8ysThIvn/VojIyMjIyPP+bS1sUQIV2s95pBDDvmbP/mdkft83tpYguZq5Jh/OeaYh+yzy8hTHvNlaxNNczm+la9OTlar1UdA/+C2A4trRCnD3jS8BB1obq2Gk6GU6QbQAS4BUaYSQAf4bhhKKTFdAzrAOwAxEUAH+KEM01SY3gM6wBsEAQB0gJ+maZoC3gI6iPYaAIBJsiRmHU0AALOeFC3aK2cWAACUXe7+AwO0lc9eTHYTAAAAAElFTkSuQmCC);
        }

        #files .icon-php .name {
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAGsSURBVDjLjZNLSwJRFICtFv2AgggS2vQLDFvVpn0Pi4iItm1KItvWJqW1pYsRemyyNILARbZpm0WtrJ0kbmbUlHmr4+t0z60Z7oSSAx935txzvrlPBwA4EPKMEVwE9z+ME/qtOkbgqtVqUqPRaDWbTegE6YdQKBRkJazAjcWapoGu6xayLIMoilAoFKhEEAQIh8OWxCzuQwEmVKtVMAyDtoiqqiBJEhSLRSqoVCqAP+E47keCAvfU5sDQ8MRs/OYNtr1x2PXdwuJShLLljcFlNAW5HA9khLYp0TUhSYMLHm7PLEDS7zyw3ybRqyfg+TyBtwl2sDP1nKWFiUSazFex3tk45sXjL1Aul20CGTs+syVY37igBbwg03eMsfH9gwSsrZ+Doig2QZsdNiZmMkVrKmwc18azHKELyQrOMEHTDJp8HXu1hostG8dY8PiRngdWMEq467ZwbDxwlIR8XrQLcBvn5k9Gpmd8fn/gHlZWT20C/D4k8eTDB3yVFKjX6xSbgD1If8G970Q3QbvbPehAyxL8SibJEdaxo5dikqvS28sInCjp4Tqb4NV3fgPirZ4pD4KS4wAAAABJRU5ErkJggg==);
        }

    </style>
    <script>
        function $(id) {
            var el = 'string' == typeof id ?
                document.getElementById(id) :
                id;

            el.on = function(event, fn) {
                if ('content loaded' == event) {
                    event = window.attachEvent ? "load" : "DOMContentLoaded";
                }
                el.addEventListener ?
                    el.addEventListener(event, fn, false) :
                    el.attachEvent("on" + event, fn);
            };

            el.all = function(selector) {
                return $(el.querySelectorAll(selector));
            };

            el.each = function(fn) {
                for (var i = 0, len = el.length; i < len; ++i) {
                    fn($(el[i]), i);
                }
            };

            el.getClasses = function() {
                return this.getAttribute('class').split(/\s+/);
            };

            el.addClass = function(name) {
                var classes = this.getAttribute('class');
                el.setAttribute('class', classes ?
                    classes + ' ' + name :
                    name);
            };

            el.removeClass = function(name) {
                var classes = this.getClasses().filter(function(curr) {
                    return curr != name;
                });
                this.setAttribute('class', classes.join(' '));
            };

            return el;
        }

        function search() {
            var str = $('search').value.toLowerCase();
            var links = $('files').all('a');

            links.each(function(link) {
                var text = link.textContent.toLowerCase();

                if ('..' == text) return;
                if (str.length && ~text.indexOf(str)) {
                    link.addClass('highlight');
                } else {
                    link.removeClass('highlight');
                }
            });
        }

        $(window).on('content loaded', function() {
            $('search').on('keyup', search);
        });
    </script>
</head>

<body class="directory">
    <div id="wrapper">
        <h1><a href="<?= $dir ?>">~</a> <?= $dir ?> </h1>
        <input id="search" type="text" placeholder="Search" autocomplete="off">
        <ul id="files" class="view-tiles">
            <?php
            foreach ($files as $file) {
                if (is_file($dir . $file)) { ?>
                    <li><a href="<?= $file ?>" class="icon icon icon-<?= pathinfo($file, PATHINFO_EXTENSION) ?>" title="<?= $file ?>"><span class="name"><?= $file ?></span><span class="size"><?= filesize($dir . $file) ?></span><span class="date"><?= date('m/d/Y H:i:s A', filemtime($dir . $file)) ?></span></a></li>
            <?php }
            } ?>
        </ul>
    </div>

</body>

</html>