<link href="/assets/css/bootstrap.css" rel="stylesheet">
<?php echo $script; ?>
<div class="row">
    <div class="col-lg-3">
        &nbsp;
    </div>
    <div class="col-lg-6">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Choose</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($files as $file) {
                echo "  <tr>
                                <td>{$file['name']}</td>
                                <td>{$file['choose']}</td>
                            </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-3">
        &nbsp;
    </div>

</div>
