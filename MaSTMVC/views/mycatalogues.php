<?php
/** @var $this View */
use app\core\View;
require_once ("core/Catalogue.php");

$this->title = 'My Catalogues';
?>
<img
        src="../../views/assets/plus-sign.svg"
        alt="add-sign"
        class="plus-sign trigger"
        id="addTrigger"
/>
<?php echo $catalogues?>


<!-- MODAL CONTENT -->

<div class="modal" id="addModal">
    <div class="modal-content">
        <span class="close-button" id="add-close-button">×</span>
        <h1>Create a catalogue</h1>
        <form method="post" action="">
            <div class="input-container">
                <input type="text" name="title" required/>
                <label>Catalogue Title</label>
            </div>
            <button type="submit" class="btn">submit</button>
        </form>
    </div>
</div>
