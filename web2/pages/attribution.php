<?php
require("header.php");

if (!isset($_GET['date'])){
    header('Location: dashboard.php');
}

$date = $_GET['date'];

$date = explode('-', $date);

?>

<body>

<h1 id="titleAttribution"><?php echo $date[2]."-".$date[1]."-".$date[0] ?></h1>



<!--    <table class="table table-borderless" id="tableAttribution">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th scope="col">Clients</th>-->
<!--            <th scope="col">Last</th>-->
<!--            <th scope="col">Handle</th>-->
<!--            <th scope="col">Prestataires</th>-->
<!---->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        <tr>-->
<!--            <td>Mark</td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td>Mark</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Jacob</td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td>Mark</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Larry</td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td>Mark</td>-->
<!--        </tr>-->
<!--        </tbody>-->
<!--    </table>-->
<!--<style>-->
<!--    TABLE {-->
<!--        float : left;-->
<!--        margin-left : 5px;-->
<!--    }-->
<!--</style>-->
<!---->
<!--<table border="1">-->
<!--    <tr>-->
<!--        <td>fef </td>-->
<!--        <td>effe </td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>fefe </td>-->
<!--        <td>feef </td>-->
<!--    </tr>-->
<!--</table>-->
<!--<table border="1">-->
<!--    <tr>-->
<!--        <td>effe </td>-->
<!--        <td>effe </td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>efe </td>-->
<!--        <td>efe </td>-->
<!--    </tr>-->
<!--</table>-->
<!--<br clear="left">-->
<!--<table border="1">-->
<!--    <tr>-->
<!--        <td> rffr</td>-->
<!--        <td>frf </td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>frfr </td>-->
<!--        <td>fr </td>-->
<!--    </tr>-->
<!--</table>-->
<!---->
<!--</body>-->

<div class="row">
    <div class="table-responsive col-md-6">
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
    <div class="table-responsive col-md-6">
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
</html