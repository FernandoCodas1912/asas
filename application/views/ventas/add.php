<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content-page -->
    <div class="content">
        <!-- Start content -->
        <div class="container">
            <?php
            if ($this->session->flashdata("success")) : ?>

                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        &times;
                    </button>
                    <strong>
                        ¡Buen Trabajo!
                    </strong>
                    <p>
                        <?php echo $this->session->flashdata("success") ?>
                    </p>
                </div>

            <?php endif; ?>
            <?php
            if ($this->session->flashdata("error")) : ?>

                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        &times;
                    </button>
                    <strong>
                        ¡Error!
                    </strong>
                    <p>
                        <?php echo $this->session->flashdata("error") ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <div class="card-box">
            <!--inicio card box -->
            <h4 class="header-title m-t-0 m-b-30">Nueva Venta</h4>
            <div class="form-group row">
                <form class="form-horizontal" role="form" id="datos_factura_ventas" action="#" method="post">

                    <div class="form-group">

                        <label for="nombre" class="col-md-1 control-label">Cliente</label>
                        <div class="form-group col-md-3 col-sm-12 col-xs-12">
                            <span class="input-group-btn">

                                <input type="hidden" id="id_cliente" name="id_cliente" class="" placeholder="">
                                <input type="text" id="razonsocial_cliente" name="razonsocial_cliente" class="form-control col-md-2" placeholder="" readonly="">


                                <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal-buscar-cliente"><i class="fa fa-search"></i>Buscar Cliente</button>
                            </span>
                        </div>


                        <label for="fecha" class="col-md-2 col-sm-12 col-xs-12 control-label">Fecha</label>
                        <div class="input-group col-md-2 col-sm-12 col-xs-12 pull-left">
                            <input type="text" class="form-control fecha-autoclose" placeholder="mm/dd/yyyy" name="fecha" id="datepicker-autoclose" value="<?php echo date("Y-m-d"); ?>" readonly>
                            <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>

                        </div>
                        <label for="fecha" class="col-md-2 col-sm-12 col-xs-12 control-label">Comprobante</label>
                        <div class="input-group col-md-2 col-sm-12 col-xs-12 pull-left">
                            <select class='form-control' name="id_tipocomprobante" id="id_tipocomprobante" required>
                                <!--combo dinamico desde la base de datos-->
                                <option value="" selected="" disabled="">Seleccione</option>
                                <?php foreach ($comprobantes as $comprobante) : ?>
                                    <?php if ($comprobante->id_comprobante != 4) { ?>
                                        <?php $datacomprobante = $comprobante->id_comprobante . '*' . $comprobante->ultimo_nro . '*' . $comprobante->serie_comprobante . '*'; ?>
                                        <option value="<?php echo $datacomprobante; ?>">
                                            <?php echo $comprobante->id_comprobante . "-" . $comprobante->descripcion; ?>
                                        </option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <input type="hidden" id="tipo_comprobante" name="tipo_comprobante">
                        <label for="numero_factura" class="col-md-1 col-xs-12 control-label">Serie</label>
                        <div class="input-group col-sm-12 col-xs-12 col-md-1 pull-left">
                            <input type="text" class="form-control" name="serie_comprobante_venta" id="serie_comprobante_venta" placeholder="000-000" maxlength="7" value="" readonly required>
                        </div>

                        <label for="numero_factura" class="col-md-1 col-xs-12 control-label">Nro. Comprobante</label>
                        <div class="input-group col-sm-12 col-xs-12 col-md-1 pull-left">
                            <input type="text" class="form-control" name="nro_op" id="nro_op" placeholder="Nro." value="" required readonly>
                        </div>
                        <input type="text" name="id_formapago" id="id_formapago">

                        <label for="condicion" class="col-md-1 col-xs-12 control-label">Condicion Venta</label>
                        <div class="col-md-2">
                            <select class='form-control' name="condicion" id="condicion" required>
                                <option value="1" SELECTED>Contado</option>
                                <option value="2">Credito</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <div class="pull-right">
                                <button type="button" id="btn_add_products" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-buscar-productos">
                                    <span class="glyphicon glyphicon-search"></span> Agregar productos
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group table-responsive">
                        <!-- tabla item de productos agregados -->
                        <table id="tbventas" class="table table-bordered  table-hover">
                            <thead>
                                <td>Codigo</td>
                                <td>Descripcion</td>
                                <td>Cantidad</td>
                                <td>Precio</td>
                                <td>Total</td>
                                <td>Acciones</td>
                            </thead>
                            <tbody>
                                <!-- esto se carga desde el footer -->
                            </tbody>
                        </table>
                        <!-- fin tabla item de productos agregados -->
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 pull-right">
                            <div class="input-group m-t-10">
                                <span class="input-group-addon">Total Iva Incl. </span>
                                <input type="text" id="totales" name="totales" class="form-control" placeholder="">
                                <span class="input-group-addon"> Gs.</span>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-2 pull-right">
                        <div class="input-group m-t-10">
                            <button type="submit" class="btn btn-success">
                                <span class="fa fa-save"></span> Guardar Venta
                            </button>
                        </div>
                    </div>
            </div> <!-- form-group -->
            </form>
        </div>
    </div>
    <!-- Modal // buscar cliente cambiar clase por modal fade si queres con efectos-->
    <div class="modal bs-example-modal-xs" id="modal-buscar-cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Buscar Clientes </h4>
                </div>
                <div class="modal-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <td>Nro. documento</td>
                            <td>Nombre y Apellido</td>
                            <td>Acciones</td>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($clientes)) : ?>
                                <?php foreach ($clientes as $cliente) : ?>
                                    <tr>
                                        <td><?php echo $cliente->id_cliente . " - " . $cliente->nrodocumento; ?></td>
                                        <td><?php echo $cliente->razonsocial; ?></td>
                                        <?php $datacliente = $cliente->id_cliente . "*" . $cliente->razonsocial; ?>
                                        <td>
                                            <!-- usa del modelo la funcion correspondiente -->
                                            <button type="button" class="btn btn-success btn-check" value="<?php echo $datacliente; ?>"><i class="fa fa-check"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- Fin Modal content-->
        </div><!-- Fin Modal dialog-->
    </div><!-- Fin Modal fade-->
    <!-- Fin Modal // buscar clientes-->

    <!-- Modal Productos-->
    <div class="modal bs-example-modal-lg" id="modal-buscar-productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Buscar productos para agregar a la Venta </h4>
                </div>
                <div class="modal-body table-responsive">
                    <table id="example2" class="table table-inverse table-bordered table-hover table-responsive">
                        <thead>
                            <td>Codigo</td>
                            <td>Descripcion</td>
                            <td>Precio</td>
                            <td>Acciones</td>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($servicios)) : ?>
                                <?php foreach ($servicios as $servicio) : ?>
                                    <tr>
                                        <td><?php echo $servicio->id_producto; ?></td>
                                        <td><?php echo $servicio->descripcion; ?></td>
                                        <td><?php echo $servicio->precio_venta; ?></td>
                                        <?php $dataproducto = $servicio->id_producto . "*" . $servicio->descripcion . "*" . $servicio->precio_venta; ?>
                                        <td>
                                            <!-- usa del modelo la funcion correspondiente -->
                                            <button type="button" class="btn btn-success btn-agregar" value="<?php echo $dataproducto; ?>"><i class="fa fa-check"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div> <!-- fin modal content-->
        </div> <!-- Fin Modal dialog-->
    </div> <!-- Fin Modal fade-->
    <!-- Fin Modal Productos-->



    <!-- Modal cobrar-->
    <div class="modal bs-example-modal-lg" id="modal_fin_venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Finalizar Venta </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form method="post" name="formventas" id="formventas" action="#">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Va a pagar con</label>
                                <select class='form-control form-white' name="IdFormaPago" id="IdFormaPago" required>
                                    <!--combo dinamico desde la base de datos-->
                                    <?php var_dump($formapago) ?>
                                    <?php foreach ($formapago as $pago) : ?>
                                        <option value="<?php echo $pago->id_formapago; ?>">
                                            <?php echo $pago->id_formapago . "-" . $pago->descripcion; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Total Venta</label>
                                <input class="form-control form-white" name="total" id="total_venta" type="text" />
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label class="control-label"> Recibido </label>
                                <input class="form-control form-white" name="recibido" id="MontoRecibido" autofocus type="text" value="0" min="0" pattern="^[0-9]+" />
                            </div>
                            <div class="col-md-6" id="ReturnChange">
                                <h1></h1>
                            </div>

                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btnSave"> <i class="fa fa-save"></i> Terminar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar
                        </button>
                    </div>
                </form>
            </div><!-- Fin Modal content-->
        </div><!-- Fin Modal dialog-->
    </div><!-- Fin Modal-->