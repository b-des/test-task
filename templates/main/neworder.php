<?php include 'header.php'; ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <form class="form-horizontal" action="" method="post">
            <fieldset>
                <!-- Form Name -->
                <legend>Нове замовлення</legend>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="textinput">Назва страви</label>
                    <div class="col-md-4">
                        <input id="textinput" name="title[0]" type="text" placeholder="Назва страви" class="form-control input-md" required="">
                    </div>
                    <div class="col-md-2">
                        <input id="textinput" name="quantity[0]" type="number" placeholder="Кількість" class="form-control input-md" required="">
                    </div>
                    <a href="#" class="btn btn-info col-md-1" id="addInput">Ще страва</a>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="color">Номер столу</label>
                    <div class="col-md-6">
                        <input id="color" name="table" type="number" placeholder="0" class="form-control input-md">
                    </div>
                </div>
                <input type="hidden" name="waiter" value="<?php echo $_SESSION['username'] ?>">
                <input type="hidden" name="action" value="NewOrder">

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="submitButton"></label>
                    <div class="col-md-8">
                        <button id="submitButton" name="submitButton" type="submit" class="btn btn-success">Відправити</button>
                        <button id="cancel" name="cancel" type="reset" class="btn btn-inverse">Скасувати</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<!-- /.container -->

<div class="container">

    <hr>
    <?php include 'footer.php'; ?>
