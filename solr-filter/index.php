<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link href="https://code.jquery.com/ui/1.9.2/themes/cupertino/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            html,body {
                direction: rtl;
            }
            body {
                width: 1000px;
                margin: auto;
                font-size: 12px;
            }
            .clearfix:before,
            .clearfix:after {
                content: " ";
                /* 1 */

                display: table;
                /* 2 */

            }
            .clearfix:after {
                clear: both;
            }
        </style>
        <link href="solr-filter.css" rel="stylesheet" type="text/css"/>

        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
        <script src="mustache.js"></script>
        <script src="solr-filter.js"></script>
    </head>
    <body>

        <?php
            $curr_category = '';
            include('filter.php')
        ?>



        <script id="selected-cat-tmpl" type="x-tmpl-mustache">
            <div class="category clearfix">
                <span>{{cat}}</span> <span class="close">x</span>
            </div>
        </script>

        <script id="documents-tmpl" type="x-tmpl-mustache">
            <h2>
דפים מתאימים
            </h2>
            <div class="summary">
            נמצאו
            {{numDocuments}}
            דפים מתאימים
            </div>

            {{#documents}}
            <div class="document">
                <a href="/{{title}}" target="_blank">{{title}}</a>
            </div>
            {{/documents}}
        </script>

        <script id="facets-tmpl" type="x-tmpl-mustache">
            <h2>
קטגוריות נבחרות
            </h2>

            {{#facets}}
            <div class="category">
                <span class="cat">{{category}}</span> <span class="count">({{count}})</span>
            </div>
            {{/facets}}
        </script>

    </body>
</html>
