<?php

$dipartimenti = listaDipartimenti($cid);

?>

			<div class="content-body">
				<div class="row page-titles mx-0">
					<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Crea Riunione</h4>
								<label class="mr-sm-2"></label>
                                <div class="basic-form">
                                    <form>
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2">Dipartimento</label>
                                                <select class="custom-select mr-sm-2" name="dipartimento" id="dipartimento" onchange="listaSale(this.value)">
                                                    <option selected="selected">Seleziona Dipartimento...</option>
                                                    <?php 
						    while($row = $dipartimenti->fetch_assoc())
						    {
							echo "<option value=\"".$row['nome']."\">".$row['nome']."</option>";
						    }												
						    ?>
                                                </select>
                                            </div>
                                        </div>
										<label class="mr-sm-2"></label>
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2">Sala Riunione</label>
                                                <select class="custom-select mr-sm-2" name="sala" id="sala">
                                                    <option selected="selected">Seleziona Sala...</option>
                                                </select>
                                            </div>
                                        </div>
										<label class="mr-sm-2"></label>
										<div class="example">
                                            <label class="mr-sm-2">Data</label>
                                            <div class="input-group">
                                                <input type="date" placeholder="mm/dd/yyyy"> 
                                            </div>
                                        </div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
