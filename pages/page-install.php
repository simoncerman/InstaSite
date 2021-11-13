<?php

/**
 * Only when site is started new
 */

include dirname(getcwd(), 1) . '/pageParts/head-global.php';
?>

<body>
    <div class="install-wrapper">
        <div class="name-select">
            <h2>Site creator</h2>
            <p>Name for site</p>
            <input type="text" class="form-control" id="InputNameSiteInstall">
            <br>
        </div>
        <span class="site-line"></span>
        <div class="type-select">
            <div onclick="selectOne(this)" class="specific-type">eshop</div>
            <div onclick="selectOne(this)" class="specific-type">site app</div>
            <div onclick="selectOne(this)" class="specific-type">presentation</div>
            <div onclick="selectOne(this)" class="specific-type">firm</div>

        </div>
        <button onclick="installNext()" type="button" id="" class="btn btn-primary" btn-lg btn-block">Next</button>
    </div>
</body>