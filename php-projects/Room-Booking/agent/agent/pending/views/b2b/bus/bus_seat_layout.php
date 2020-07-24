
<?php
//echo '<pre>';print_r($resp);
if ($resp != '') {
    $seats = $resp->seats;
//  echo '<pre>';print_r($seats);exit;
    foreach ($resp->seats as $val) {
        $i = $val->column;
        $j = $val->row;
        $Rowno[$i] = $val->column;
        $Colno[$j] = $val->row;
    }
    $li = max($Rowno);
    $lj = max($Colno);
    ?>
    <!--<span class="seatclose"><i class="fa fa-times-circle"></i></span>-->
    <span class="tip">
        Tip:  Click on an available seat/sleeper to select it. Click again to de-select it.
    </span>
    <div class="row">
        <div class="col-md-9">
            <div class="seatHolder">
                <div class="upperDeck" style="display:none;">

                </div>
                <div class="lowerDeck">
                    <span class="bus-label seater"></span>
                    <div class="seatlayout">
                        <?php for ($i = 0; $i <=$lj; $i++) { ?>
                            <div class="seat-row">
                                <?php for ($j = 0; $j <= $li; $j++) { ?>
                                    <div style="width: 38px;">
                                        <?php
                                        foreach ($resp->seats as $val) {
                                            if ($val->column == $j && $val->row == $i) {
                                                echo '<a ';

                                                if ($val->available == 'false') {
                                                    echo 'class="booked-seat"';
                                                } elseif ($val->available == 'true' && $val->ladiesSeat == 'false') {
                                                    echo 'class="available-seat"';
                                                } elseif ($val->available == 'true' && $val->ladiesSeat == 'true') {
                                                    echo 'class="ladies-seat"';
                                                }
                                                echo '>';

                                                echo $val->name;

                                                echo '</a>';
                                            }
                                        }
                                        ?>                               
                                    </div>
                                <?php } ?>

                            </div>
                        <?php } ?>

                        <!--                        <div class="seat-row"></div>-->

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group seatContinue">
                        <select class="form-control">
                            <option value="All" selected>Boarding points</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                            <option value="5">Five</option>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button">
                                Continue <i class="fa fa-hand-o-right"></i></button>
                        </span>
                    </div>
                    <div class="col-md-12 newmemberTip"><span>New! </span><a href="#">Help me select the boarding point</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <ul class="seatSelectionInfo">
                <li><span class="available-seat"></span>Available seat</li>
                <li><span class="booked-seat"></span>Booked seat</li>
                <li><span class="ladies-seat"></span>Ladies seat</li>
                <li><span class="selected-seat"></span>Selected seat</li>
            </ul>
            <div class="seat-Fare">
                <div>
                    <span>Seat(s) :</span> <span class="selected-seat-nos"> A1, A2</span>
                </div>
                <div>
                    <span>Amount :</span> <i class="fa fa-rupee"></i><span class="seat-amount">550</span>
                </div> 
            </div>
        </div>
    </div>

<?php } ?>
<script>
    $(function(){
        $('a.available-seat, a.ladies-seat').click( function(){
            $(this).toggleClass('selected-seat');
        });
        $('a.available-sleeper, a.ladies-sleeper, a.ladies-sleeperV, a.available-sleeperV').click( function(){
            $(this).toggleClass('selected-sleeper');
        });
			
    });
</script>