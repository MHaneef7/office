<?php  include('header.php'); ?>
<style>
    .module_main {
        width: 1110px;
        height: 530px;
        border: 1PX solid black;
    }
    .box_select{
        width: 200px;
        height: 200px;
        border: 1px solid black;
    }
    .anchor {
        width: 100%;
        height: 50px;
        border: 1px solid black;
    }
</style>

<div class="module">
    <div class="container">
        <div class="module_main">
            <div class="box_select">
              <div class="anchor"> <i href="#">Dasheboard</i> </div>
              <div class="anchor"> <i href="#">Attendance</i> </div>
              <div class="anchor"> <i href="#">Leave</i> </div>
              <div class="anchor"> <i href="#">Work Shifts</i> </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.html');?>