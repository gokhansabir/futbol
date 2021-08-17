<?php
    require("config/config.php");
    $pageTitle = "Ana sayfa";
    $section = "home";
    include(ROOT_PATH . 'src/views/header.php');
?>

<div class="main" style="background-color: #f4f4f4">
    <div class="container">
        <div class="main_content">
            <h1>İnsider Futbol Simülasyonu</h1>
            <p><strong>Sim Football</strong></p>
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <a class="btn btn-primary" style="float: right" href="src/views/createTeams.php">Takımları Oluştur</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>