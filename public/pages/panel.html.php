<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Panel Principal</title>

    <style>
        button, .btn, input[type="button"], input[type="submit"], .hover-scale-up
        {
            transition: transform 0.3s ease-in-out;
        }

        button:hover, .btn:hover, input[type="button"]:hover, input[type="submit"]:hover, .hover-scale-up:hover
        {
            transform: scale(1.1);
        }
        .scale-down
        {
            height: auto;
            width: 60%;
        }
    </style>

</head>
<body style="font-family: 'Montserrat';">
    <!-- 
        Aqui va a todo el codigo asqueroso para la interfaz de miembro y admin, la idea es que sea una 
        sola ventana comun con el mismo header y el mismo footer, pero dependiendo de si es admin o no
        se muestran controles adicionales y tablas adicionales, todo eso con la magia de phpsito
    -->

    <header>
        <?php 
            require __DIR__ . '/../../app/templates/header.html.php'; 
        ?>
    </header>

    <main>
        <?php if ($selectedMenu == "Colaboradores"): ?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <form>
                            <div class="container ps-0 ms-0">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="tbCedula" class="form-label text-black">Cédula</label>
                                        <input type="number" placeholder="Ej: 31000000" min="0" step="1" name="tbCedula" class="form-control border border-dark">
                                    </div>
                                    <div class="col">
                                        <label for="tbName" class="form-label text-black">Nombre</label>
                                        <input type="text" name="tbName" class="form-control border border-dark">
                                    </div>
                                    <div class="col">
                                        <label for="tbLastName" class="form-label text-black">Apellido</label>
                                        <input type="text" name="tbLastName" class="form-control border border-dark">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-5">
                                        <label for="tbPhone" class="form-label text-black">Teléfono/s</label>
                                        <input type="tel" placeholder="Ej: 0416-0000000,0424-0000000" name="tbPhone" class="form-control border border-dark">
                                    </div>
                                    <div class="col">
                                        <label for="tbDetails" class="form-label text-black">Detalles (opcional)</label>
                                        <input type="text" name="tbDetails"placeholder="Ej: Ofrece hogar temporal" class="form-control border border-dark">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <input type="checkbox" name="ckMember" class="form-check-input border border-dark" value="">
                                        <label for="ckMember" class="form-check-label">Nuevo miembro</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="tbEmail" class="form-label text-black">Correo electrónico</label>
                                        <input type="email" name="tbEmail" class="form-control border border-dark">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="tbPassword" class="form-label text-black">Contraseña</label>
                                        <input type="password" name="tbPassword" class="form-control border border-dark">
                                    </div>
                                    <div class="col">
                                        <label for="tbPasswordConfirm" class="form-label text-black">Confirmar contraseña</label>
                                        <input type="password" name="tbPasswordConfirm" class="form-control border border-dark">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="tbCity" class="form-label text-black">Ciudad/Pueblo/Localidad</label>
                                        <input type="text" name="tbCity" class="form-control border border-dark">
                                    </div>
                                    <div class="col">
                                        <label for="tbStreet" class="form-label text-black">Calle</label>
                                        <input type="text" name="tbStreet" class="form-control border border-dark">
                                    </div>
                                    <div class="col">
                                        <label for="tbMunicipality" class="form-label text-black">Municipio</label>
                                        <select class="form-select border border-dark" aria-label="Default select example">
                                            <option value="" disabled selected hidden> </option>
                                            <option value="Antolin">Antolín</option>
                                            <option value="Arismendi">Arismendi</option>
                                            <option value="Antonio Diaz">Antonio Diaz</option>
                                            <option value="Garcia">García</option>
                                            <option value="Gomez">Gómez</option>
                                            <option value="Maneiro">Maneiro</option>
                                            <option value="Marcano">Marcano</option>
                                            <option value="Marinio">Mariño</option>
                                            <option value="Macanao">Macanao</option>
                                            <option value="Tubores">Tubores</option>
                                            <option value="Villalba">Villalba</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="col">
                                            <label for="tbReference" class="form-label text-black">Punto de referencia (opcional)</label>
                                            <input type="text" name="tbReference" placeholder="Ej: Frente al kiosco ----" class="form-control border border-dark">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <input type="checkbox" name="ckIsAdmin" class="form-check-input border border-dark" value="">
                                        <label for="ckIsAdmin" class="form-check-label">Es Administrador</label>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-5 justify-content-betweenn">
                                    <div class="col">
                                        <input type="submit" name="btRegistrar" class="btn btn-success" value="Registrar">
                                    </div>
                                    <div class="col text-end">
                                        <input type="submit" name="btRegistrar" class="btn btn-primary" value="Actualizar">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        efefce
                    </div>
                </div>
            </div>
        <?php endif ?>
    </main>

    <footer>

    </footer>
</body>
</html>