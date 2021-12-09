<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/head.php';
    ?>
</head>

<body>
    <div class="small-wrap">
        <div class="title-section">
            <p>Just parts to choose...</p>
            <h2>Part menu settings</h2>
        </div>
        <div class="parts">
            <p>basics</p>
            <div class="part">
                <h3>Header</h3>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="part">
                <h3>Footer</h3>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            <p>other shit..</p>
            <div class="part">
                <h3>Main wrapper</h3>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="part">
                <h3>Site gallery</h3>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="part">
                <h3>Contact form</h3>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
        <button class="btn-wide">Site Completed</button>
    </div>
</body>

</html>