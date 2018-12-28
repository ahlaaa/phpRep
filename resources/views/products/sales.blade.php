<div class="tab-pane fade" id="vips">
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;">
        <div class="col-sm-3" style="background-color: #ccc;min-height: 75%;">会员折扣</div>
        <div class="col-sm-7" style="margin-left: 25px;background-color: #ccc;padding: 10px 10px;min-height: 75%;">
            <label class="col-sm-12" style="background-color: #0e90d2;padding: 5px 15px;">
                <p>只有当折扣大于0，小于10的情况下才能生效，否则按自身会员等级折扣计算</p>
                <p> 如果折扣为空或者0，则不设置折扣, 折扣和固定金额都有,则优先使用折扣</p>
                <p>如果会员价为空或者0，则不设置会员价</p>
            </label>
            <?php $grades = app(\App\Models\Grade::class)->get();
                $pro_grades = $product->grades??[];
                $grades_list = array();
                foreach ($pro_grades as $k=>$v){
                    $grades_list[$v->id] = $v;
                }
            ?>
            @foreach($grades as $grade)
            <label class="col-sm-12">
                <span class="col-sm-2" style="margin: 8px auto;">{!! $grade->name !!}:</span>
                <input type="number" name="grades[{!! $grade->id !!}][percentage]" value="{!! ($grades_list[$grade->id]->pivot??null)->percentage??'' !!}" class="form-group form-control col-sm-10" step="0.01" style="width: 27%;margin: 8px auto;padding-right: 25px;"/>
                <span class="form-group form-control col-sm-3" style="border: 1px solid white;margin: 8px auto;width: 19%;">折 或者 会员价</span>
                <input type="number" name="grades[{!! $grade->id !!}][price]" value="{!! ($grades_list[$grade->id]->pivot??null)->price??'' !!}" class="form-group form-control col-sm-10" style="width: 27%;margin: 8px auto;" step="0.01">
                <span class="form-group form-control col-sm-3" style="width: 6%;border: 1px solid white;margin: 8px auto;">元</span>
            </label>
            @endforeach
<!--            <label class="col-sm-12">-->
<!--                <span class="col-sm-2" style="margin: 8px auto;">默认会员:</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" step="0.01" style="width: 27%;margin: 8px auto;padding-right: 25px;"/>-->
<!--                <span class="form-group form-control col-sm-3" style="border: 1px solid white;margin: 8px auto;width: 19%;">折 或者 会员价</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" style="width: 27%;margin: 8px auto;" step="0.01">-->
<!--                <span class="form-group form-control col-sm-3" style="width: 6%;border: 1px solid white;margin: 8px auto;">元</span>-->
<!--            </label>-->
<!--            <label class="col-sm-12">-->
<!--                <span class="col-sm-2" style="margin: 8px auto;">vip会员:</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" step="0.01" style="width: 27%;margin: 8px auto;padding-right: 25px;"/>-->
<!--                <span class="form-group form-control col-sm-3" style="border: 1px solid white;margin: 8px auto;width: 19%;">折 或者 会员价</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" style="width: 27%;margin: 8px auto;" step="0.01">-->
<!--                <span class="form-group form-control col-sm-3" style="width: 6%;border: 1px solid white;margin: 8px auto;">元</span>-->
<!--            </label>-->
<!--            <label class="col-sm-12">-->
<!--                <span class="col-sm-2" style="margin: 8px auto;">高级会员:</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" step="0.01" style="width: 27%;margin: 8px auto;padding-right: 25px;"/>-->
<!--                <span class="form-group form-control col-sm-3" style="border: 1px solid white;margin: 8px auto;width: 19%;">折 或者 会员价</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" style="width: 27%;margin: 8px auto;" step="0.01">-->
<!--                <span class="form-group form-control col-sm-3" style="width: 6%;border: 1px solid white;margin: 8px auto;">元</span>-->
<!--            </label>-->
<!--            <label class="col-sm-12">-->
<!--                <span class="col-sm-2" style="margin: 8px auto;">至尊会员:</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" step="0.01" style="width: 27%;margin: 8px auto;padding-right: 25px;"/>-->
<!--                <span class="form-group form-control col-sm-3" style="border: 1px solid white;margin: 8px auto;width: 19%;">折 或者 会员价</span>-->
<!--                <input type="number" class="form-group form-control col-sm-10" style="width: 27%;margin: 8px auto;" step="0.01">-->
<!--                <span class="form-group form-control col-sm-3" style="width: 6%;border: 1px solid white;margin: 8px auto;">元</span>-->
<!--            </label>-->
        </div>
    </div>
</div>
