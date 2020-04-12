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
                        <th scope="col" class="thAttribution">Clients</th>
                        <th scope="col" class="thAttribution">Last</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="tdAttribution">Mark</td>
                        <td class="tdTarget"><div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
                    </tr>
                    <tr>
                        <td class="tdAttribution">Jacob</td>
                        <td class="tdTarget"><div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)"></div></td>
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
                        <th scope="col" class="thAttribution">Prestataire</th>
                        <th scope="col" class="thAttribution">Last</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="tdAttribution">Mark</td>
                        <td class="tdTarget">
                            <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <p ondragstart="dragStart(event)" draggable="true" id="1" class="targetText">Mark Paul</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdAttribution">Jacob</td>
                        <td class="tdTarget">
                            <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <p ondragstart="dragStart(event)" draggable="true" id="2" class="targetText">Jacob Paul</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
    </div>
</div>





<p style="clear:both;"><strong>Note:</strong> drag events are not supported in Internet Explorer 8 and earlier versions or Safari 5.1 and earlier versions.</p>

<p id="demo"></p>

<script>
    function dragStart(event) {
        event.dataTransfer.setData("Text", event.target.id);
        document.getElementById("demo").innerHTML = "Started to drag the p element";
    }

    function allowDrop(event) {
        event.preventDefault();
    }

    function drop(event) {
        event.preventDefault();
        var data = event.dataTransfer.getData("Text");
        event.target.appendChild(document.getElementById(data));
        document.getElementById("demo").innerHTML = "The p element was dropped";
    }
</script>

</body>
</html