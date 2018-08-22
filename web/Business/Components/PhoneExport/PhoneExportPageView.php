<?php
use \ShinyBaseWeb\Business\Components\PhoneExport\PhoneExportPage;
/* @var $this PhoneExportPage */
?>
<html>
<header>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        function copy() {
            $('#phone-list').select();
            document.execCommand('copy');
        }
    </script>
</header>

<body class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="input-group col-sm-10 col-12">
                    <?php if ($this->previousExists()) : ?>
                        <a class="btn btn-secondary input-group-addon" href="<?= $this->getPrevious() ?>">&lt; Prev</a>
                    <?php endif; ?>
                    <h5 class="form-control text-center">Client phones - Page <?= $this->getPage() ?></h5>
                    <?php if ($this->nextExists()) : ?>
                        <a class="btn btn-secondary input-group-addon" href="<?= $this->getNext() ?>">Next &gt;</a>
                    <?php endif; ?>
                </div>
                <button type="button" class="btn-block btn btn-primary col-sm-2 col-12" onclick="copy()">Copy</button>
            </div>
        </div>
        <div class="card-block">
            <textarea id="phone-list" class="form-control col-12 h-75"><?= $this->customersPhoneList ?></textarea>
        </div>
    </div>
</body>
</html>