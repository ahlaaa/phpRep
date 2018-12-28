<div class="tab-pane fade" id="orders_user">
    <div  style="padding: 35px 0px!important;">
        <?php $orders = $user->orders; ?>
        <div class="form-group col-sm-12">
            <div class="col-sm-3">
                <span>成交订单数</span>
            </div>
            <div class="col-sm-7">
                <input class="form-control" type="number" readonly value="{!! $orders->count(1)??0 !!}" />
            </div>
        </div>
        <div class="form-group col-sm-12">
            <div class="col-sm-3">
                <span>成交金额</span>
            </div>
            <div class="col-sm-7">
                <input class="form-control" type="number" step="0.01" readonly value="{!! $orders->sum('amount')??0.00 !!}" />
            </div>
        </div>
        <div class="form-group col-sm-12">
            <div class="col-sm-3">
                <span>最后一次成交时间</span>
            </div>
            <div class="col-sm-7">
                <input class="form-control" type="text" readonly value="{!! isset($orders->first()->deal_time)?$orders->first()->deal_time:'无任何交易' !!}" />
            </div>
        </div>
    </div>
    <div>

    </div>
</div>