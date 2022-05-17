    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Prossima Riunione</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tema</th>
                                <th>Sala</th>
                                <th>Data</th>
                                <th>Orario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                echo "<td>" . $row['tema'] . "</td>"
                                    . "<td>" . $row['salariunioni'] . "</td>"
                                    . "<td>" . $row['data_riunione'] . "</td>"
                                    . "<td>" . $row['ora'] . "</td>";
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
