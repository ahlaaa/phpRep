<table class="table table-responsive" id="systemConfigs-table">
    <thead>
        <tr>
            <th>Img Slide</th>
            <th>Img Ad</th>
            <th>Introduce</th>
            <th>Enterprise Synopsis</th>
            <th>Enterprise Situation</th>
            <th>Enterprise Growth</th>
            <th>Enterprise Coalition</th>
            <th>Enterprise Address</th>
            <th>Enterprise Telephone</th>
            <th>Enterprise Email</th>
            <th>Qrcode1</th>
            <th>Qrcode2</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($systemConfigs as $systemConfig)
        <tr>
            <td>{!! $systemConfig->img_slide !!}</td>
            <td>{!! $systemConfig->img_ad !!}</td>
            <td>{!! $systemConfig->introduce !!}</td>
            <td>{!! $systemConfig->enterprise_synopsis !!}</td>
            <td>{!! $systemConfig->enterprise_situation !!}</td>
            <td>{!! $systemConfig->enterprise_growth !!}</td>
            <td>{!! $systemConfig->enterprise_coalition !!}</td>
            <td>{!! $systemConfig->enterprise_address !!}</td>
            <td>{!! $systemConfig->enterprise_telephone !!}</td>
            <td>{!! $systemConfig->enterprise_email !!}</td>
            <td>{!! $systemConfig->qrcode1 !!}</td>
            <td>{!! $systemConfig->qrcode2 !!}</td>
            <td>{!! $systemConfig->updated_user_id !!}</td>
            <td>{!! $systemConfig->updated_user_name !!}</td>
            <td>{!! $systemConfig->created_user_id !!}</td>
            <td>{!! $systemConfig->created_user_name !!}</td>
            <td>
                {!! Form::open(['route' => ['systemConfigs.destroy', $systemConfig->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('systemConfigs.show', [$systemConfig->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('systemConfigs.edit', [$systemConfig->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>