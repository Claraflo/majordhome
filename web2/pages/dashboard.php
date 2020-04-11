<?php
require("header.php");

$mois = date('m');
$annee = date('Y');
?>

<body>

<div id="arrow">
    <i class="fas fa-arrow-circle-left fa-3x" id="prev"></i>
    <i class="fas fa-arrow-circle-right fa-3x" id="next"></i>
</div>

<div id="content">
</div>

<script type="text/javascript">

    jQuery(function($){

        var mois = <?php echo $mois; ?>;
        var annee = <?php echo $annee; ?>;

        $(document).ready(function(){

            $("#content").load("calendar.php?mois="+mois+"&annee="+annee+"");

        });

        $("#prev").click(function(){

            mois--;

            if (mois < 1) {
                annee--;
                mois = 12;
            }

            $("#content").load("calendar.php?mois="+mois+"&annee="+annee+"");

        });

        $("#next").click(function(){

            mois++;

            if (mois > 12) {
                annee++;
                mois = 1;
            }

            $("#content").load("calendar.php?mois="+mois+"&annee="+annee+"");

        });

    });

</script>
</body>
</html>
