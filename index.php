<?php include('layouts/header.php') ?>

<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center col-8">
            <h1>Descubra o seu signo</h1>
            <form action="show_zoadic_sign.php" method="post">
                <label class="form-label">Data de nascimento</label>
                <input type="date" name="data" class="form-control m-2">
                <input type="submit" value="Enviar" class="btn btn-outline-light">
            </form>
        </div>
    </div>
</body>

</html>