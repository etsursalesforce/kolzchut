        <div id="filter" data-category="<?=$curr_category ?>">
            <div id="search-categories">
                <h2>
                    חיפוש קטגוריות
                </h2>
                <input name="text"/>
            </div>
            <div id="active-categories">
                <h2>
                    קטגוריות שנבחרו
                </h2>
            </div>
            <div id="proposed-categories">
                <h2>
                </h2>
            </div>

        </div>
        <div id="results">
        </div>



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
                <a href="/index.php/{{title}}" target="_blank">{{title}}</a>
                <div>{{#info}}<div>{{.}}</div>{{/info}}</div>
                {{^info}}<div>{{summary_t}}</div>{{/info}}
            </div>
            {{/documents}}
        </script>

        <script id="guides-tmpl" type="x-tmpl-mustache">
            <h2>
                {{title}}
            </h2>
            <div class="guides clearfix">
            {{#items}}
            <div class="guide">
                <a href="/index.php/{{title}}" target="_blank">{{title}}</a>
            </div>
            {{/items}}
            </div>
        </script>

        <script id="facets-tmpl" type="x-tmpl-mustache">
            <h2>
קטגוריות נוספות
            </h2>

            {{#facets}}
            <div class="category">
                <span class="cat">{{category}}</span> <span class="count">({{count}})</span>
            </div>
            {{/facets}}
        </script>

