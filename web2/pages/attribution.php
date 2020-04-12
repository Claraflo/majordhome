<?php
require("header.php");

if (!isset($_GET['date'])){
    header('Location: dashboard.php');
}

$date = $_GET['date'];

$date = explode('-', $date);

?>

<body id="attribution">

<h1 id="titleAttribution"><?php echo $date[2]."-".$date[1]."-".$date[0] ?></h1>



<div class="row">
    <div class="table-responsive col-md-6">
            <div class="overflow">
                <table class="table table-borderless" id="tableAttribution">
                    <thead>
                    <tr>
                        <th scope="col">Clients</th>
                        <th scope="col">Last</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Mark</td>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Mark</td>
                    </tr>
                    </tbody>
                </table>
            </div>
    </div>
    <div class="table-responsive col-md-6">
            <div class="overflow">
                <table class="table table-borderless" id="tableAttribution">
                    <thead>
                    <tr>
                        <th scope="col">Prestataire</th>
                        <th scope="col">Last</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Mark</td>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Mark</td>
                    </tr>
                    </tbody>
                </table>
            </div>
    </div>
</div>

</body>
</html