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


<ul class="list-group" id="demo1">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Morbi leo risus</li>
    <li class="list-group-item">Porta ac consectetur ac</li>
    <li class="list-group-item">Vestibulum at eros</li>
</ul>
<ul class="list-group mt-4" id="demo2">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Morbi leo risus</li>
    <li class="list-group-item">Porta ac consectetur ac</li>
    <li class="list-group-item">Vestibulum at eros</li>
</ul>

</body>
</html