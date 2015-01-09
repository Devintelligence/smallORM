<div class="listView">

    <div class="toolbar top">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>

    {foreach key=key item=value from=$list} 



        <div class="panel panel-default">
            <div class="panel-heading">{$value->title}</div>
            <div class="panel-body">
                {$value->description}
            </div>
        </div>

        <div class="entry">

            <div class="title">{$value->title}</div>
            <div class="subtitle">{$value->subtitle}</div>
            <div class="additional">
                {$value->additional}
            </div>

            <div class="description">

                {$value->description}
            </div>


        </div>

    {/foreach}

    <div class="toolbar bottom">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>

</div>