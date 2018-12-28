<div class="tab-pane fade" id="detail">
    <div class="col-sm-12 ls_div pull-left" style="margin-top: 9px;display: flex;">
        <div class="col-sm-3" style="background-color: #ccc;min-height: 75%;">
            <p>详情</p>
        </div>
        <div class="col-sm-7 form-group col-lg-7" style="margin-left: 25px;background-color: #ccc;padding: 10px 10px;min-height: 75%;">
<!--            <div class="form-group col-sm-12 col-lg-12">-->
                <div id="content_div" style="width:100%; height:200px;">{!! optional($product??null)->content??'' !!}</div>
                {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'id'=> 'content','style'=>'resize:none;']) !!}
<!--            </div>-->
        </div>
    </div>
</div>