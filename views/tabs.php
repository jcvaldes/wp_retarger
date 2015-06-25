<?php //var_dump(  $edit['split']['limit']  ); exit; ?>
<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h2><?php esc_attr_e( 'Herramientas de Remarketing', 'wp_admin_style' ); ?></h2>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<div class="inside">

							<div role="tabpanel">
								<h3 class="nav-tab-wrapper">
									<a class="nav-tab nav-tab-active"
										rel="avp_unicode_charkbd_admin_menu_panel_0"
										href="javascript:void( 0 );"
										title="Configura tus rutas"> Ruta </a> <a
										class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_1"
										href="javascript:void( 0 );"
										title="Configura tu imagen"> Redirección de Imágen</a>
									<a class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_2"
										href="javascript:void( 0 );"
										title="Elige un Popup"> Popup </a>
									<a
										class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_3"
										href="javascript:void( 0 );"
										title="Agregar un pixel de trackeo"> Pixel </a>
									<a
										class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_4"
										href="javascript:void( 0 );"
										title="Split Testing"> Split Test/Rotator </a>

								</h3>
								<!-- Nav tabs -->
								<form name="wp_retarger_form" method="post" class="form-horizontal" role="form" action="?page=wp_retarger" enctype="multipart/form-data">

								    <div class="nav-tab-contents m-t-20" id='avp_unicode_charkbd_admin_menu_panel_0'>
                                        <div class="form-group">
                                            <label for="name_router" class="col-sm-3 control-label">Nombre</label>
                                            <div class="col-sm-7">
                                            	<input type="text" id="name_router" name="name_router" class="form-control" value="<?= $edit['name_router'] ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="urlembed_router" class="col-sm-3 control-label">Url Embebida</label>
                                            <div class="col-sm-7">
                                				<input type="text" id="urlembed_router" name="urlembed_router" class="form-control" value="<?= $edit['urlembed_router'] ?>" />
										    </div>
                                        </div>
                                    </div>

                                    <div class="nav-tab-contents  m-t-20" id='avp_unicode_charkbd_admin_menu_panel_1' style='display: none;'>

                                        <div class="form-group">
                                            <label for="url_image_redirect" class="col-sm-3 control-label">Imagen de la Url</label>
                                            <div class="col-sm-7">
                                    			<input type="text" id="url_image_redirect" name="url_image_redirect" class="form-control" value="<?php echo (isset($edit['popup']['image'])) ? $edit['popup']['image'] : ''  ?>"/>
												<input type="file" name="picture" id="picture">
									        </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="url_image_redirect_description" class="col-sm-3 control-label">Descripción</label>
                                            <div class="col-sm-7">
											     <input type="text" id="url_image_redirect_description" name="url_image_redirect_description" class="form-control" />
                                            </div>
                                        </div>

                                    </div>


                                    <div class="nav-tab-contents  m-t-20" id='avp_unicode_charkbd_admin_menu_panel_2' style='display: none;'>
                                        <table class="form-table" >
    										<tbody>
    											<tr valign="top" class="even">
    												<td><img src="<?php echo plugin_dir_url( __FILE__ )  . '../img/popup1.jpg'?>" width="180" height="120" />
    													<div class="pt-10" />
    													<input type="radio" class="popup-type" name="popup-type" value="1" checked><strong>Tipo 1</strong></td>
    												<td><img src="<?php echo plugin_dir_url( __FILE__ )  . '../img/popup2.jpg'?>" width="180" height="120" />
    													<div class="pt-10" />
    													<input type="radio" class="popup-type two" name="popup-type" value="2"><strong>Tipo 2</strong></td>
    												<td><img src="<?php echo plugin_dir_url( __FILE__ )  . '../img/popup3.jpg'?>" width="180" height="120" />
    													<div class="pt-10" />
    													<input type="radio" class="popup-type tres" name="popup-type" value="3"><strong>Tipo 3</strong></td>
    											</tr>

    									   </tbody>
    									</table>

                                        <div class="form-group for-type-2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="popup-width" class="col-sm-3 control-label">Ancho</label>

                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input name="popup-width" type="text" class="form-control" value="<?php echo (isset($edit['popup']['width'])) ? $edit['popup']['width'] : '800'  ?>" aria-describedby="basic-addon2">
                                                            <span class="input-group-addon" id="basic-addon2">px</span>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-md-6">
                                                    <label for="popup-height" class="col-sm-3 control-label">Alto</label>

                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input name="popup-height" type="text" class="form-control" value="<?php echo (isset($edit['popup']['height'])) ? $edit['popup']['height'] : '600'  ?>" aria-describedby="basic-addon2">
                                                            <span class="input-group-addon" id="basic-addon2">px</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row m-t-20">
                                                <div class="for-type-2">
                                                    <label for="url_image_redirect" class="col-sm-3 control-label">Tipo de Popup:</label>
                                                    <div class="col-sm-7">
                                                        Por Url: <input type="radio" class="popup-show" name="popup-show" value="url" checked>
                                                        Por HTML: <input type="radio" class="popup-show html" name="popup-show" value="html">
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row m-t-20">
                                                <div class="for-url">
                                                    <label for="url-popup" class="col-sm-2 control-label">URL:</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="url-popup" maxlength="255" class="form-control" value="<?php echo (isset($edit['popup']['url'])) ? $edit['popup']['url'] : ''  ?>">
                                                   </div>

                                                </div>

                                                <div class="for-html" style="display:none">
                                                    <label for="url-popup" class="col-sm-2 control-label">Código:</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="html-popup" class="form-control" rows=5 cols="80"><?php echo (isset($edit['popup']['html'])) ? $edit['popup']['html'] : ''  ?></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group for-type-3">

                                            <div class="row">
                                                <label for="position" class="col-sm-3 control-label">Posición:</label>
                                                <div class="col-sm-7">
													Abajo: <input type="radio" name="position" value="bottom" checked>
													Arriba: <input type="radio" name="position" value="top"  <?php echo ($edit['popup']['position'] == 'top') ? 'checked' : ''  ?>>

                                               </div>
                                            </div>

                                            <div class="row m-t-20">
                                                <label for="image-click" class="col-sm-3 control-label">Click en la Imagen?:</label>
                                                <div class="col-sm-7">
													Sí: <input type="radio" name="image-click" class="form-control image-click" value="1" checked>
													No: <input type="radio" name="image-click" class="form-control image-click" value="0" <?php echo ($edit['popup']['click'] === false) ? 'checked' : ''  ?>>
													<br>
													<div class="for-click-true m-t-10">

													<input type="text" class="form-control col-sm-10" name="image-click-url" placeholder="Ingresar una URL" maxlength="255" value="<?php echo (isset($edit['popup']['image-click-url'])) ? $edit['popup']['image-click-url'] : ''  ?>">
													</div>
                                               </div>

                                            </div>


                                            <div class="row m-t-20">
                                                <label for="title" class="col-sm-3 control-label">Título:</label>
                                                <div class="col-sm-7">
													<input type="text" name="title" class="form-control" value="<?php echo (isset($edit['popup']['title'])) ? $edit['popup']['title'] : ''  ?>">
                                               </div>

                                            </div>

                                            <div class="row m-t-20">
                                                <label for="description" class="col-sm-3 control-label">Descripción:</label>
                                                <div class="col-sm-7">
													<textarea name="description" rows="5" class="form-control"><?php echo (isset($edit['popup']['description'])) ? $edit['popup']['description'] : ''  ?></textarea>
								              </div>

                                            </div>


                                            <div class="row m-t-20">
                                                <div class="col-sm-3">
                                                    <label for="button-text" class="control-label col-sm-12">Botón:</label>
                                                    <br>
                                                    <div class="col-md-offset-6 col-sm-6 text-center m-t-20">
                                                        <button id="example-btn" type="button" class="btn ">Ejemplo</button>
                                                    </div>

                                                </div>

                                                <div class="col-sm-7">
                                                    <div class="row from-group">
                                                        <div class="col-sm-4">
                                                            <label for="button-text" class="control-label">Texto:</label>
                                                        </div>

                                                        <div class="col-sm-8">
                                                            <input type="text" id="button-text" name="button-text" class="form-control" value="<?php echo (isset($edit['popup']['button']['text'])) ? $edit['popup']['button']['text'] : ''  ?>">
                                                        </div>
                                                    </div>


                                                    <div class="row from-group m-t-10">
                                                        <div class="col-sm-4">
                                                            <label for="button-url" class="control-label">URL:</label>
                                                        </div>

                                                        <div class="col-sm-8">
                                                            <input type="text" id="button-url" name="button-url" class="form-control" value="<?php echo (isset($edit['popup']['button']['url'])) ? $edit['popup']['button']['url'] : ''  ?>">
                                                        </div>
                                                    </div>


                                                    <div class="row from-group m-t-10">
                                                        <div class="col-sm-4">
                                                            <label for="button-background" class="control-label">Color de Fondo:</label>
                                                        </div>

                                                        <div class="col-sm-8">
                                                            <input type="text" id="button-background" name="button-background" class="form-control" value="<?php echo (isset($edit['popup']['button']['background'])) ? $edit['popup']['button']['background'] : ''  ?>">
                                                        </div>
                                                    </div>


                                                    <div class="row from-group m-t-10">
                                                        <div class="col-sm-4">
                                                            <label for="button-color" class="control-label">Color del Texto:</label>
                                                        </div>

                                                        <div class="col-sm-8">
                                                            <input type="text" id="button-color" name="button-color" class="form-control" value="<?php echo (isset($edit['popup']['button']['color'])) ? $edit['popup']['button']['color'] : ''  ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                   </div>


								   <div class="nav-tab-contents  m-t-20" id='avp_unicode_charkbd_admin_menu_panel_3' style='display: none;'>

                                        <div class="form-group">
                                            <div class="col-sm-9">
                       					        <textarea id="wp_retarger_pixel" name="wp_retarger_pixel" rows="5" cols="80" class="form-control"><?= $edit[ 'pixel'] ?></textarea>
									        </div>
                                        </div>
                                    </div>

                                    <div class="nav-tab-contents  m-t-20" id='avp_unicode_charkbd_admin_menu_panel_4' style='display: none;'>

                                        <div class="row hide" id="header">
                                            <div class="col-md-2 col-md-offset-10">
                                                <div class="col-md-6" style="background-color:#ccc;font-weight:bold">Vis </div>
                                                <div class="col-md-6" style="background-color:#ccc;font-weight:bold">Con</div>
                                            </div>
                                        </div>

                                        <div class="row m-t-10" id="urls">
                                        <? $index = 0; ?>
                                            <?php if(isset($edit['split']['urls'])){

                                                foreach ($edit['split']['urls'] as $key => $url) { $index = $index + $url['visit'];?>
                                                <div class="col-md-12 m-t-10 url">
                                                    <div class="col-md-10">
                                                        <label for="split_rotator_url-'+indexcharp+'" class="col-sm-3 control-label">Url a Incrustar #<?php echo $key+1  ?></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="split_rotator_url[]" class="form-control" value="<?= $url['url'] ?>" />
                                                            <input type="hidden" name="split_rotator_visit[]" value="<?= $url['visit'] ?>">
                                                        </div>
                                                        <div class="col-sm-1 form-inline">
                                                            <button type="button" class="remove-url">x</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php if($url['static'] == true){ ?>
                                                            <div class="col-md-4 col-md-offset-2" style="background-color: green"><?= $url['visit'] ?></div>
                                                        <?php } else {?>
                                                            <div class="col-md-4 col-md-offset-2"><?= $url['visit'] ?></div>
                                                        <?php } ?>

                                                        <div class="col-md-4 col-md-offset-2">0</div>
                                                    </div>
                                                </div>

                                            <?php } } ?>

                                            <input type="hidden" id="url-count" value="<?php echo (isset($edit['split']['urls'])) ? count($edit['split']['urls']) : 0 ?>">
                                        </div>

                                        <div class="row m-t-10 hide" id="footer">
                                            <div class="col-md-10 text-right">
                                                <strong>Total:</strong>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="col-md-6 text-center" style="background-color:#eee;font-weight:bold"><?= $index ?></div>
                                                <div class="col-md-6 text-center" style="background-color:#eee;font-weight:bold">0</div>
                                            </div>
                                        </div>

                                        <div class="row m-t-10 hide" id="counter">
                                            <div class="col-md-10 text-right">
                                                <strong>Número de Visitas hasta fijar la mejor Url(0 = no es fija)</strong>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="visit-limit" value="<?php echo (isset($edit['split']['limit'])) ? $edit['split']['limit'] : 0 ?>">
                                            </div>
                                            <hr class="col-md-11">
                                        </div>


                                        <div class="row m-t-10" id="add">
                                            <div class="col-md-12">
                                                <div class="col-md-10">
                                                    <label for="split_rotator_url_other" class="col-sm-3 control-label">Agregar URL:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="url-to-add" class="form-control" placeholder="http://example.com" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-success" type="button" id="add-url">Agregar</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                     <br>
									<p>
										<input class="btn btn-primary" type="submit" name="wp_retarger_username_submit" value="Guardar" />
									</p>
									<?php if(isset($edit[ 'ID'])){  ?>
									<input type="hidden" name="action" value="update">
									<input type="hidden" name="id" value="<?= $edit['ID'] ?>">
									<input type="hidden" id="type" value="<?= $edit['type'] ?>">
									<input type="hidden" id="type-show" value="<?= $edit['popup']['show'] ?>">
									<?php } else { ?>
									<input type="hidden" name="action" value="create">
									<?php } ?>
								</form>

							</div>
						</div>
						<!-- .inside -->
					</div>
					<!-- .postbox -->
				</div>
				<!-- .meta-box-sortables .ui-sortable -->
			</div>
			<!-- post-body-content -->
		</div>
		<!-- #post-body .metabox-holder .columns-2 -->
		<br class="clear">
	</div>
	<!-- #poststuff -->
</div>
<!-- .wrap -->