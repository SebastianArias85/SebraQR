<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />        
</head>

<body>

    <!--BARRA DE NAVEGACION-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navGrande" style="color:red;">
        <img class="escudoChikito" src="../assets/img/SISPE.png" alt="addPC" /><a class="navbar-brand" href="#">QR
            Lector</a>


        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <!--
            <li class="nav-item">
                <a class="nav-link userName" href="#">Bienvenido <?php echo $usuario; ?></a>
            </li>
            -->
            </ul>
        </div>

        <form class="form-inline">
            <!-- Example single danger button -->
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                    data-display="static" aria-expanded="false">
                    <?php echo $usuario; ?>
                </button>
                <div class="dropdown-menu dropdown-menu-lg-right">
                    <a class="dropdown-item" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    <a class="dropdown-item" href="listado.php"><i class="fa fa-eye" aria-hidden="true"></i> Ver
                        todos</a>
                    <a class="dropdown-item" href="cargar.php"><i class="fa fa-plus" aria-hidden="true"></i> Agregar
                        Computador</a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item link-verde" href="../controlador/download_excel.php" id="basico"><i
                            class="fa fa-download" aria-hidden="true" type="submit"></i> Descargar EXCEL</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../controlador/cerrar_sesion.php" style="color:#df0b0b;"><i
                            class="fa fa-times-circle" aria-hidden="true"></i>
                        Cerrar Sesión</a>
                </div>
            </div>
            <!-- Example single danger button -->
        </form>

    </nav>
    <!--BARRA DE NAVEGACION-->

    <!--BARRA DE NAVEGACION chica-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navChico">
        <img class="escudoChikito" src="../assets/img/SISPE.png" alt="addPC" /><a class="navbar-brand" href="#">QR
            Lector</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" style="font-weight:600;"><?php echo $usuario; ?> <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i>
                        Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listado.php"><i class="fa fa-eye" aria-hidden="true"></i>
                        Ver todos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cargar.php"><i class="fa fa-plus" aria-hidden="true"></i>
                        Agregar Computador</a>
                </li>
                <div class="dropdown-divider"></div>

                <li>
                    
                    <a class="nav-link link-verde" href="../controlador/download_excel.php"><i class="fa fa-download" aria-hidden="true"></i>
                        Descargar EXCEL</a>
                </li>

                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a class="nav-link" href="../controlador/cerrar_sesion.php" style="color:#df0b0b;"><i
                            class="fa fa-times-circle" aria-hidden="true"></i>
                        Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--BARRA DE NAVEGACION chica-->    
    
</body>

</html>