<div class="tab-pane fade  in active" id="base">
    <div class="col-sm-12 form-group " style="padding: 14px 19px;">
<!--        <div class="col-sm-3">-->
            <span>
                <img src="/{{ $user->img_head }}" onerror="javascript:this.src='{{ $user->img_head }}'" style="max-width: 75px;border-radius: 50%;" />
            </span>
<!--        </div>-->
<!--        <div class="col-sm-6">-->
            <span><input type="text" class="form-control" value="{!! $user->name !!}" style="width: 10%;display: inline-block;" readonly /></span>
<!--        </div>-->
    </div>
    <div class="col-sm-12 form-group ">
        <div class="col-sm-3">OPENID</div>
        <div class="col-sm-6"> <span><input type="text" class="form-control" value="{!! $user->open_id !!}" readonly /></span></div>
    </div>
    <div class="col-sm-12 form-group ">
        <div class="col-sm-3">会员等级</div>
        <div class="col-sm-6">
            {!! Form::select('grades_id',app(\App\Models\Grade::class)->where('type',1)->get()->pluck('name','id'),null,['class'=>'form-control','id'=>'user_grade']) !!}
        </div>
    </div>
    <div class="col-sm-12 form-group ">
        <div class="col-sm-3">标签组</div>
        <div class="col-sm-6"> <span><input type="text" name="tags" class="form-control" value="{!! $user->tags !!}" /></span></div>
    </div>
    <div class="col-sm-12 form-group ">
        <div class="col-sm-3">标签</div>
        <div class="col-sm-6">
            {!! Form::select('tag_id',app(\App\Models\Tag::class)->get()->pluck('name','id'),null,[ 'class'=>'form-control']) !!}
<!--            <span><input type="text" name="tags" class="form-control" value="{!! $user->tags !!}" /></span>-->
        </div>
    </div>
    <div class="col-sm-12 form-group ">
        <div class="col-sm-3">真实姓名</div>
        <div class="col-sm-6"> <span><input type="text" name="truename" class="form-control" value="{!! $user->truename !!}" /></span></div>
    </div>
    <div class="col-sm-12 form-group ">
        <div class="col-sm-3">微信号</div>
        <div class="col-sm-6"> <span><input type="text" name="wechat" class="form-control" value="{!! $user->wechat !!}" /></span></div>
    </div>
    <div class="col-sm-12 form-group ">
        <div class="col-sm-3">手机号码</div>
        <div class="col-sm-6"> <span><input type="text" name="telephone" class="form-control" value="{!! $user->telephone !!}" /></span></div>
    </div>
    <div class="col-sm-12 form-group ">
        <div class="col-sm-3">用户密码</div>
        <div class="col-sm-6"> <span><input type="text" id="password" class="form-control" value="{{ $user->password }}" onchange="javascript:change_pwd(this);" /></span></div>
    </div>
</div>