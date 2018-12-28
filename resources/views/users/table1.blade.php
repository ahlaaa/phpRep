<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th>id</th>
            <th>姓名</th>
            <!-- <th>用户名</th> -->
            <!--<th>微信</th>-->
            <th>电话</th>
            <!-- <th>Email</th> -->
            <th>状态</th>
            <th>类型</th>
            <th>等级/区域</th>
            <th>推荐人</th>
	    <th>加入时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->id !!}</td>
            <td>{!! $user->name !!}</td>
            <!-- <td>{!! $user->username !!}</td> -->
            <!--<td>{!! $user->wechat !!}</td>-->
            <td>{!! $user->telephone !!}</td>
            <!-- <td>{!! $user->email !!}</td> -->
            {{--<td>{!! $user->open_id !!}</td>--}}
            <td>{!! $user->status_str !!}</td>
            <td>{!! $user->type_str !!}</td>
            <td>
            @if($user->grade_id === 2)
                {!! $user->province . $user->city . $user->county !!}
            @elseif($user->grade_id === 3)
                {!! $user->province . $user->city !!}
            @elseif($user->grade_id === 4)
                {!! $user->province !!}
            @endif
                {!! $user->grade->name !!}
            </td>
            <td>{!! $user->superior->name !!}</td>
	    <td>{!! $user->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                <button alt="会员详情" title="会员详情" class="btn btn-default my_btn" type="button" data-toggle="modal" data-target="#contentModal{{ $user->id }}">
                <i class="glyphicon glyphicon-eye-open"></i>
                    </button>
                    @if($user->type === 2)
                        <a alt="团队信息" title="团队信息" href="{!! route('users.tree', [$user->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-tree-conifer"></i></a>
                    @endif
                    {{--<a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a alt="编辑用户信息" title="编辑用户信息" href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default '><i class="glyphicon glyphicon-edit"></i></a>
                    <a alt="修改密码" title="修改密码" href="{!! route('users.password', [$user->id]) !!}" class='btn btn-default'><i class="glyphicon glyphicon-lock"></i></a>
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('确定删除吗？')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@foreach($users as $user)
<div class="modal inmodal fade" id="contentModal{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 950px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">会员详情</h4>
            </div>
            <div class="modal-body" style="height:auto ">
                <ul id="myTab{{ $user->id }}" class="nav nav-tabs">
                    <li class="active">
                        <a href="#info{{ $user->id }}" data-toggle="tab">
                            会员详情
                        </a>
                    </li>

                    <li><a href="#order{{ $user->id }}" data-toggle="tab">用户订单</a></li>


                    <li><a href="#jiangl{{ $user->id }}" data-toggle="tab">奖励记录</a></li>


                    <!-- <li><a href="#up{{ $user->id }}" data-toggle="tab">等级变更记录</a></li> -->
                    <li><a href="#team{{ $user->id }}" data-toggle="tab">团队</a></li>

                </ul>
                <div id="myTabContent{{ $user->id }}" class="tab-content">
                    <div class="tab-pane fade in active" id="info{{ $user->id }}">
                        <table class="table">
                            <thead style="border: 1px solid;text-align: center;">
                            <th colspan="3">会员详情</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>用户id:<span id="t1_id">{{ $user->id??null }}</span></td>
                                <td>姓名:<span id="t1_user_name">{{ $user->name??null }}</span></td>
                                <td>注册时间:<span id="t1_regtime">{{ $user->created_at??null }}</span></td>
                            </tr>
                            <tr>
                                <td>用户身份:<span id="t1_grade">@if(!empty($user->grade)){{ $user->grade->name??null }}@endif</span></td>
                                <td>注册地区:<span id="t1_regori">{{ $user->province??null }}</span></td>
                    
                            </tr>
                            <tr>
                                <td>状态:<span id="t1_status">{{ $user->status_str??null }}</span></td>
                                <td colspan="2">手机:<span id="t1_tel">{{ $user->telephone??null }}</span></td>
                            </tr>
                            
                            <tr>
                            @if(!empty($user->superior))
                                <td>推荐人id:<span id="t1_refeid">{{ $user->superior->id??null }}</span></td>
                                <td>推荐人姓名:<span id="t1_refename">{{ $user->superior->name??null }}</span></td>
                            @endif
                                <td>身份证号:<span id="t1_innum">{{ $user->identification_card??null }}</span></td>
                            </tr>
                            
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3">详细地址:<input type="text" id="t1_add"
                                                            value="{{ $user->province??null }}-{{ $user->city??null }}-{{ $user->county??null }}"
                                                            disabled/>
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="order{{ $user->id }}" style="height: 350px;overflow: auto;">
                        <table class="table">
                            <thead>
                            <td>序号</td>
                            <td>订单编号</td>
                            <td>商品数量</td>
                            <td>订单金额</td>
                            <td>下单时间</td>
                            <td>购买用户</td>
                            <td>订单状态</td>
                            <td>送货地址</td>
                            </thead>
                            <tbody>
                            <?php $orders = app(\App\Models\Order::class)->with("products")->where("user_id",$user->id)->get()->toArray(); ?>
                            {{-- {!! sizeof(constant('BARTER_STATUS' )) !!} --}}
                            @foreach($orders as $k=>$order)
                            <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $order['number']??null }}</td>
                            <td>
                            @if(isset($order))
                            @forelse($order['products'] as $product)
                                    {!! $product['pivot']['qty'] !!}&nbsp;&nbsp;&nbsp;
                            @empty
                                数据错误，没有产品信息
                            @endforelse
                            @endif
                            </td>
                            <td>{{ $order['amount']??null }}</td>
                            <td>{{ $order['created_at']??null }}</td>
                            <td>{{ $user->name??null }}</td>
                            <td>{{ $order['status_str']??null }}</td>
                            <td><?php 
                            $addr = app(\App\Models\Address::class)->where("id",$order['address_id'])->first();
                            echo ($addr->province??null).'-'.($addr->city??null).'-'.($addr->county??null).'-'.($addr->street??null);
                            ?></td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="jiangl{{ $user->id }}" style="height: 350px;overflow: auto;">
                        <table class="table">
                            <thead>
                            <td>id</td>
                            <td>获奖人</td>
                            <td>来源</td>
                            <td>类别</td>
                            <td>奖励金额</td>
                            <td>奖励时间</td>
                            </thead>
                            <tbody>
                            <?php 
                            $ub_list = app(\App\Models\Rebate::class)->where("user_id",$user->id)->get()->toArray(); 
                            ?>
                            @foreach($ub_list as $ul)
                            <tr>
                                <td>{{ $ul['id'] }}</td>
                                <td>{{ $user['name'] }}</td>
                                <td>订单:<?php echo app(\App\Models\Order::class)->where("id",$ul['order_id'])->first()->number??null; ?></td>
                                <td>{{ $ul['remark'] }}</td>
                                <td>{{ $ul['amount'] }}</td>
                                <td>{{ $ul['created_at'] }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="team{{ $user->id }}" style="height: 350px;overflow: auto;">
                        <table class="table">
                            <thead>
                            <td>id</td>
                            <td>名称</td>
                            <td>等级</td>
                            <td>状态</td>
                            </thead>
                            <tbody id="t_body{{ $user->id }}">
                            <?php 
                            $u_list = array();
                            $u_list = app(\App\Models\User::class)->getTeams($user->id,$u_list); 
                            ?>
                            @foreach($u_list as $ul)
                            <tr>
                            <td>{{ $ul['id']??null }}</td>
                            <td>{{ $ul['name']??null }}</td>
                            <td>
                            <?php 
                                $grade = app(\App\Models\Grade::class)->where("id",$ul['grade_id'])->pluck('name')[0]??null; 
                            ?>
                            {{ $grade }}
                            </td>
                            <td>{{ $ul['status_str']??null }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="up{{ $user->id }}" style="height: 350px;overflow: auto;">
                        <table id="table{{ $user->id }}" class="table">
                            <thead>
                            <td>序号</td>
                            <td>原等级</td>
                            <td>新等级</td>
                            <td>升级途径</td>
                            <td>升级时间</td>
                            </thead>
                            <tbody>
                            
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="subContent" style="display: none">保存</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@section('scripts')
<script>
    $(function(){
        var val =  $("#s_type").val();
        if(val == 0){
            $("#s_ipt").val('name:like;username:like;wechat:like;telephone:like;email:like;');
            $("#s_types").hide();
        }else if(val == 1){
            $("#s_types").show();
            $("#s_ipt").val('superior_id:=;');
        }
    })
    $("#s_type").on('change',function(){
        var val = $(this).val();
        // alert(val);
        if(val == 0){
            $("#s_ipt").val('name:like;username:like;wechat:like;telephone:like;email:like;');
            $("#s_types").hide();
        }else if(val == 1){
            $("#s_types").show();
            $("#s_ipt").val('superior_id:=;');
        }
    });
    $("#s_types").on('change',function(){
        var val = $(this).val();
        $("#s_sch1").val(val);
        // alert(val);
        // if(val == 0){
        //     $("#s_ipt").val('name:like;username:like;wechat:like;telephone:like;email:like;');
        // }else{
        //     $("#s_ipt").val('superior_id:=;');
        // }
    });
    $("#s_sch").blur(function(){
        $.ajax({
            url:'http://yhs.yungx.xyz/api/v1/users?type=2&search='+$("#s_sch").val()+'&searchFields=name:like',
            data:'',
            dataType:"JSON",
            type:"GET",
            success:function(res){
                var data = res.data;
                $("#s_types").html("<option>无用户</option>");
                $.each(data,function(k,v){
                    if(v.type == 2){
                        var str = "<option value="+v.id+">"+v.name+"</option>";
                        $("#s_types").append(str);
                    }
                })
                
                console.log(res);
            }
        });
    });
    
</script>
@endsection