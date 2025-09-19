<?php
    include('header.php');
    include('database/database.php'); 
?>

<style>
    .box_main {
        width: 1181px;
        height: 365px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
    .QR_img img {
        width: 300px;
        height: 300px;
        border: 3px solid black;
        object-fit: contain;
    }
</style>

<div class="box">
    <div class="container">
        <div class="box_main">
            <div class="QR_image">
                <div class="QR_img">
                    <?php  
                        if (isset($_SESSION['QRpath']) && !empty($_SESSION['QRpath'])) { 
                            ?>
                            <img src="<?php echo $_SESSION['QRpath']; ?>" alt="QR Code">
                            <?php
                        }
                        else {
                            echo "<p>No QR Code found.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.html'); ?>
