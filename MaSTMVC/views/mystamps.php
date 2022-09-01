<?php

/** @var $this View */

use app\core\View;

require_once("core/Stamp.php");

$this->title = 'My stamps';

?>
<img src="../../views/assets/plus-sign.svg" alt="add-sign" class="plus-sign trigger" id="addTrigger" />

<?php echo $stamps ?>

<!-- MODAL CONTENT -->

<div class="modal" id="addModal">
    <div class="modal-content">
        <span class="close-button" id="add-close-button">×</span>
        <h1>Post a stamp</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input-container">
                <input type="text" required name="name" />
                <label>Name</label>
            </div>
            <div class="input-container">
                <input type="text" required name="country" />
                <label>Country</label>
            </div>
            <div class="input-container">
                <input type="text" required name="category" />
                <label>Category</label>
            </div>
            <div class="input-container">
                <input type="text" required name="color" />
                <label>Color</label>
            </div>
            <div class="input-container">
                <input type="text" required name="height" />
                <label>Height</label>
            </div>
            <div class="input-container">
                <input type="text" required name="width" />
                <label>Width</label>
            </div>
            <div class="input-container">
                <input type="text" required name="price" />
                <label>Price</label>
            </div>
            <div class="input-container">
                <input type="text" required name="perforations" />
                <label>Perforations</label>
            </div>
            <div class="input-container">
                <input type="date" required name="issuedDateTime" />
                <label>Issued DateTime</label>
            </div>
            <div class="input-container">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <label>Upload Cover</label>
            </div>
            <button type="submit" class="btn">submit</button>
        </form>
    </div>
</div>