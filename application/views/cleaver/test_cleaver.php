<div class="container" style="background-color:#b5dffb; padding:40px; size:720px;">
    <div class="row justify-content-center">
        <div class="col-6">
            <p style="text-align:center;font-weight:bold">Haga clic en una que sea 'Más como yo' y otra que sea 'Menos como yo'.</p>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th style="text-align:center;"><i class="fas fa-plus"></i></th>
                        <th style="text-align:center;"><i class="fas fa-minus"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reactivo as $item): ?>
                        <tr class="table-light">
                            <td style="border: 1px solid #4cbed8; width:410px;height:50px;"><?php echo $item->reactivo?></td>
                            <td style="border: 1px solid #4cbed8; width:50px;height:50px;">
                                <i class="fas fa-check-circle"></i>
                            </td>
                            <td style="border: 1px solid #4cbed8; width:50px;height:50px;">
                                <button><i class="fas fa-times-circle"></i></button>
                            </td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>